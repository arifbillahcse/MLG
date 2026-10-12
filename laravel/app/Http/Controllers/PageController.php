<?php

namespace App\Http\Controllers;

use App\Models\AcceptanceLetter;
use App\Models\Accreditation;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Faculty;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\ProcessStep;
use App\Models\Result;
use App\Models\Testimonial;

class PageController extends Controller
{
    public function home()
    {
        return view('home', [
            'courses' => Course::active()->ordered()->with('levels')->get(),
            'destinations' => Destination::active()->ordered()->get(),
            'processSteps' => ProcessStep::generic()->ordered()->get(),
            'batches' => Batch::upcoming()->ordered()->with('courseLevel.course')->take(4)->get(),
            'featuredBatch' => Batch::upcoming()->where('is_featured', true)->orderBy('starts_at')->first(),
            'accreditations' => Accreditation::active()->ordered()->get(),
            'results' => Result::publishable()->ordered()->take(5)->get(),
            'faculty' => Faculty::active()->instructors()->ordered()->take(4)->get(),
            'letters' => AcceptanceLetter::publishable()->ordered()->with('destination')->take(5)->get(),
            'videoStories' => Testimonial::publishable()->ofType('video')->ordered()->take(2)->get(),
            'reviews' => Testimonial::publishable()->ofType('written')->ordered()->get(),
            'partners' => Partner::verified()->ordered()->get(),
            'mockTests' => Event::upcoming()->ofType('mock_test')->get(),
            'seminar' => Event::upcoming()->ofType('seminar')->first(),
            'posts' => Post::published()->latestFirst()->with('category')->take(3)->get(),
            'faqs' => Faq::active()->scope('home')->ordered()->get(),
            'chairman' => Page::active()->where('slug', 'chairman-message')->first(),
            'mission' => Page::active()->where('slug', 'mission')->first(),
            'vision' => Page::active()->where('slug', 'vision')->first(),
        ]);
    }

    public function about()
    {
        return view('about', [
            'chairman' => Page::active()->where('slug', 'chairman-message')->first(),
            'mission' => Page::active()->where('slug', 'mission')->first(),
            'vision' => Page::active()->where('slug', 'vision')->first(),
            'instructors' => Faculty::active()->instructors()->ordered()->get(),
            'counsellors' => Faculty::active()->counsellors()->ordered()->get(),
            'accreditations' => Accreditation::active()->ordered()->get(),
            'courses' => Course::active()->ordered()->get(),
        ]);
    }

    public function blog()
    {
        return view('blog', [
            'featured' => Post::published()->where('is_featured', true)->latestFirst()->with('category')->first(),
            'posts' => Post::published()->where('is_featured', false)->latestFirst()->with('category')->paginate(9),
            'categories' => PostCategory::ordered()->get(),
            'courses' => Course::active()->ordered()->get(),
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'courses' => Course::active()->ordered()->get(),
            'destinations' => Destination::active()->ordered()->get(),
        ]);
    }

    /**
     * Phase 6 replaces this with a {course:slug} route served by the same view.
     * The data it loads is already keyed off the model, so that is a route
     * change rather than a template change.
     */
    public function japanese()
    {
        $course = Course::active()->where('slug', 'japanese')->with('levels')->firstOrFail();

        return view('courses.show', [
            'course' => $course,
            'levels' => $course->levels,
            'faqs' => Faq::active()->scope('course')->where('course_id', $course->id)->ordered()->get(),
            'faculty' => Faculty::active()->where('course_id', $course->id)->ordered()->get(),
            'results' => Result::publishable()->where('course_id', $course->id)->ordered()->take(4)->get(),
            'batches' => Batch::upcoming()->ordered()
                ->whereHas('courseLevel', fn ($q) => $q->where('course_id', $course->id))
                ->with('courseLevel')->get(),
        ]);
    }
}
