<?php

namespace Tests\Feature;

use App\Models\Entry;
use App\Models\FeedbackMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_public_pages_and_admin_login_render(): void
    {
        foreach (['/events', '/cases', '/reviews', '/contacts', '/video', '/about-me', '/corporate-trainings', '/coaching', '/counseling', '/open-trainings', '/admin/login'] as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_admin_can_view_and_update_incoming_requests(): void
    {
        $admin = User::factory()->create();
        $request = FeedbackMessage::create([
            'name' => 'Admin Inbox Test',
            'phone' => '+380501234567',
            'email' => 'inbox@example.com',
            'message' => 'Test request',
        ]);

        $this->actingAs($admin)->get('/admin/feedback-messages')->assertOk()->assertSee('Admin Inbox Test');
        $this->actingAs($admin)->get('/admin/feedback-messages/'.$request->id.'/edit')->assertOk();
    }

    public function test_event_listing_only_shows_upcoming_events(): void
    {
        Entry::create([
            'type' => 'event', 'title' => 'Past event', 'slug' => 'past-event',
            'published_at' => now()->subDay(), 'on_main' => true,
        ]);
        Entry::create([
            'type' => 'event', 'title' => 'Upcoming event', 'slug' => 'upcoming-event',
            'published_at' => now()->addDay(), 'on_main' => true,
        ]);

        $this->get('/events')->assertOk()->assertSee('Upcoming event')->assertDontSee('Past event');
    }

    public function test_contact_form_saves_valid_requests_when_turnstile_is_not_configured(): void
    {
        config(['services.turnstile.site_key' => null, 'services.turnstile.secret_key' => null]);

        $this->from('/contacts')->post('/feedback', [
            'name' => 'Test Contact',
            'phone' => '+380501234567',
            'email' => 'client@example.com',
            'message' => 'Please contact me about a training.',
        ])->assertRedirect('/contacts')->assertSessionHas('success');

        $this->assertDatabaseHas('feedback_messages', ['email' => 'client@example.com', 'status' => 'new']);
    }

    public function test_contact_page_remains_usable_without_local_turnstile_keys(): void
    {
        config(['services.turnstile.site_key' => null, 'services.turnstile.secret_key' => null]);

        $this->get('/contacts')->assertOk()->assertDontSee('cf-turnstile');
    }

    public function test_honeypot_submissions_are_not_saved(): void
    {
        $this->from('/contacts')->post('/feedback', ['website' => 'https://spam.example'])
            ->assertRedirect('/contacts')->assertSessionHas('success');

        $this->assertDatabaseCount('feedback_messages', 0);
    }

    public function test_turnstile_is_verified_before_saving_a_contact_request(): void
    {
        config(['services.turnstile.site_key' => 'test-site-key', 'services.turnstile.secret_key' => 'test-secret']);
        Http::fake(['https://challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response(['success' => true])]);

        $this->from('/contacts')->post('/feedback', [
            'name' => 'Verified Contact',
            'phone' => '+380501234567',
            'email' => 'verified@example.com',
            'message' => 'Please contact me.',
            'cf-turnstile-response' => 'test-token',
        ])->assertRedirect('/contacts')->assertSessionHas('success');

        $this->assertDatabaseHas('feedback_messages', ['email' => 'verified@example.com']);
        Http::assertSent(fn ($request) => $request['secret'] === 'test-secret' && $request['response'] === 'test-token');
    }

    public function test_invalid_turnstile_response_does_not_save_a_contact_request(): void
    {
        config(['services.turnstile.site_key' => 'test-site-key', 'services.turnstile.secret_key' => 'test-secret']);
        Http::fake(['https://challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response(['success' => false])]);

        $this->from('/contacts')->post('/feedback', [
            'name' => 'Unverified Contact',
            'phone' => '+380501234567',
            'email' => 'unverified@example.com',
            'message' => 'Please contact me.',
            'cf-turnstile-response' => 'invalid-token',
        ])->assertRedirect('/contacts')->assertSessionHasErrors('message');

        $this->assertDatabaseMissing('feedback_messages', ['email' => 'unverified@example.com']);
    }

    public function test_database_seeder_loads_site_content_without_a_demo_admin(): void
    {
        $this->seed();

        $this->assertDatabaseHas('pages', ['slug' => 'about-me']);
        $this->assertDatabaseHas('site_settings', ['key' => 'email', 'value' => 'office@zharkov.com.ua']);
        $this->assertDatabaseMissing('users', ['email' => 'test@example.com']);
    }

    public function test_unknown_pages_use_the_branded_not_found_screen(): void
    {
        $this->get('/missing-page-for-test')->assertNotFound()->assertSee('Сторінку не знайдено');
    }
}
