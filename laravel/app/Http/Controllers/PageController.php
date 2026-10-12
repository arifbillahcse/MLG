<?php

namespace App\Http\Controllers;

/**
 * Phase 1 — pages are static Blade views.
 *
 * Each method will gain its queries in Phase 4, once the content from these
 * templates lives in the database. The view names stay the same, so the
 * templates do not move again.
 */
class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function blog()
    {
        return view('blog');
    }

    public function contact()
    {
        return view('contact');
    }

    public function japanese()
    {
        return view('courses.japanese');
    }
}
