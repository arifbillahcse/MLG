<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web routes
|--------------------------------------------------------------------------
| Phase 1: every page is still a static Blade view. Phase 4 swaps these
| closures for controller actions that read from the database, and Phase 6
| replaces the single japanese route with /courses/{slug}.
*/

Route::get('/',          [PageController::class, 'home'])->name('home');
Route::get('/about',     [PageController::class, 'about'])->name('about');
Route::get('/blog',      [PageController::class, 'blog'])->name('blog');
Route::get('/contact',   [PageController::class, 'contact'])->name('contact');

// Phase 6 turns this into Route::get('/courses/{course:slug}', ...)
Route::get('/courses/japanese', [PageController::class, 'japanese'])->name('courses.japanese');
