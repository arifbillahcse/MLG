<?php

use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web routes
|--------------------------------------------------------------------------
| Courses, destinations and posts are rows, not files. Adding a fifth
| language is a record in the admin, not a deployment.
*/

Route::get('/',        [PageController::class, 'home'])->name('home');
Route::get('/about',   [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/courses/{course:slug}', [PageController::class, 'course'])->name('courses.show');

Route::get('/study-abroad/{destination:slug}', [PageController::class, 'destination'])->name('destinations.show');
Route::get('/scholarships', [PageController::class, 'scholarships'])->name('scholarships');

Route::get('/success-stories', [PageController::class, 'stories'])->name('stories');

Route::get('/blog',          [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{post:slug}', [PageController::class, 'post'])->name('blog.show');

// Legal pages are rows in `pages`. Constrained so this cannot swallow
// every unmatched URL and turn a typo into a 500.
Route::get('/{page:slug}', [PageController::class, 'page'])
    ->whereIn('page', ['privacy-policy', 'terms', 'refund-policy'])
    ->name('pages.show');

Route::get('/sitemap.xml', \App\Http\Controllers\SitemapController::class)->name('sitemap');

Route::get('/locale/{locale}', \App\Http\Controllers\LocaleController::class)
    ->whereIn('locale', \App\Http\Middleware\SetLocale::SUPPORTED)
    ->name('locale.switch');

Route::post('/enquiry', [EnquiryController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('enquiry.store');
