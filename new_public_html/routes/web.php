<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ContactController;
use App\Models\Review;
use App\Http\Controllers\VideoController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/entries', [EntryController::class, 'index'])->name('entries.index');
Route::get('/entries/{slug}', [EntryController::class, 'show'])->name('entries.show');

Route::get('/events', [EntryController::class, 'events'])->name('events.index');
Route::get('/cases', [EntryController::class, 'cases'])->name('cases.index');
Route::get('/reviews', function () {
    $reviews = Review::where('is_published', true)->latest()->paginate(12);
    return view('frontend.reviews', compact('reviews'));
})->name('reviews.index');
Route::get('/events/{slug}', [EntryController::class, 'showEvent'])->name('events.show');
Route::get('/cases/{slug}', [EntryController::class, 'showCase'])->name('cases.show');
Route::get('/video', [VideoController::class, 'index'])->name('video.index');
Route::get('/contacts', [ContactController::class, 'show'])->name('contacts');

Route::post('/feedback', [FeedbackController::class, 'store'])
    ->middleware('throttle:3,1')
    ->name('feedback.store');

Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '^(?!admin|livewire|filament).*$')
    ->name('pages.show');
