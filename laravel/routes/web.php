<?php

use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web routes
|--------------------------------------------------------------------------
*/

Route::get('/',        [PageController::class, 'home'])->name('home');
Route::get('/about',   [PageController::class, 'about'])->name('about');
Route::get('/blog',    [PageController::class, 'blog'])->name('blog');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Phase 6 turns this into Route::get('/courses/{course:slug}', ...)
Route::get('/courses/japanese', [PageController::class, 'japanese'])->name('courses.japanese');

// All eight forms post here. Throttled per IP — a genuine visitor sends one
// or two in a sitting, so six a minute is generous and still stops a flood.
Route::post('/enquiry', [EnquiryController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('enquiry.store');
