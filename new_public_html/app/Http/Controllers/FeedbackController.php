<?php

namespace App\Http\Controllers;

use App\Models\FeedbackMessage;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Give automated submissions the same response as a successful request,
        // but do not store them or reveal that the honeypot was triggered.
        if ($request->filled('website')) {
            return back()->with('success', 'Повідомлення успішно надіслано.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $siteKey = config('services.turnstile.site_key');
        $secretKey = config('services.turnstile.secret_key');

        if (app()->environment('production') && (blank($siteKey) || blank($secretKey))) {
            Log::error('Turnstile is not configured; contact form submissions are disabled.');

            return back()->withErrors(['message' => 'Форма тимчасово недоступна. Спробуйте зв’язатися телефоном або електронною поштою.'])->withInput();
        }

        if (filled($secretKey)) {
            $token = $request->input('cf-turnstile-response');

            if (blank($token)) {
                return back()->withErrors(['message' => 'Не пройдено перевірку безпеки. Оновіть сторінку й спробуйте ще раз.'])->withInput();
            }

            try {
                $verified = Http::asForm()
                    ->timeout(5)
                    ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                        'secret' => $secretKey,
                        'response' => $token,
                        'remoteip' => $request->ip(),
                    ])
                    ->json('success');
            } catch (\Throwable $exception) {
                report($exception);
                $verified = false;
            }

            if ($verified !== true) {
                return back()->withErrors(['message' => 'Перевірка безпеки не пройдена. Спробуйте ще раз.'])->withInput();
            }
        }

        FeedbackMessage::create([
            ...$validated,
            'ip' => $request->ip(),
        ]);

        return back()->with('success', 'Повідомлення успішно надіслано.');
    }
}
