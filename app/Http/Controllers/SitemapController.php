<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Destination;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = [
            ['loc' => route('home'),          'priority' => '1.0', 'freq' => 'weekly'],
            ['loc' => route('about'),         'priority' => '0.7', 'freq' => 'monthly'],
            ['loc' => route('contact'),       'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => route('blog'),          'priority' => '0.8', 'freq' => 'weekly'],
            ['loc' => route('stories'),       'priority' => '0.7', 'freq' => 'monthly'],
            ['loc' => route('scholarships'),  'priority' => '0.8', 'freq' => 'monthly'],
        ];

        foreach (Course::active()->ordered()->get() as $course) {
            $urls[] = ['loc' => route('courses.show', $course), 'priority' => '0.9',
                       'freq' => 'monthly', 'lastmod' => $course->updated_at];
        }

        foreach (Destination::active()->ordered()->get() as $destination) {
            $urls[] = ['loc' => route('destinations.show', $destination), 'priority' => '0.9',
                       'freq' => 'monthly', 'lastmod' => $destination->updated_at];
        }

        foreach (Post::published()->latestFirst()->get() as $post) {
            $urls[] = ['loc' => route('blog.show', $post), 'priority' => '0.6',
                       'freq' => 'yearly', 'lastmod' => $post->updated_at];
        }

        foreach (Page::active()->whereIn('slug', ['privacy-policy', 'terms', 'refund-policy'])->get() as $page) {
            $urls[] = ['loc' => route('pages.show', $page), 'priority' => '0.2',
                       'freq' => 'yearly', 'lastmod' => $page->updated_at];
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
