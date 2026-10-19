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
            'faqs' => Faq::active()->forScope('home')->ordered()->get(),
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
        $featured = Post::published()->where('is_featured', true)
            ->latestFirst()->with('category')->first();

        return view('blog', [
            'featured' => $featured,
            // Exclude only the post actually shown above. Excluding every
            // featured post made a second one disappear from the site.
            'posts' => Post::published()
                ->when($featured, fn ($q) => $q->whereKeyNot($featured->getKey()))
                ->latestFirst()->with('category')->paginate(9),
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

    public function course(Course $course)
    {
        abort_unless($course->is_active, 404);

        $course->load('levels');

        return view('courses.show', [
            'course' => $course,
            'levels' => $course->levels,
            'faqs' => Faq::active()->forScope('course')->where('course_id', $course->id)->ordered()->get(),
            'faculty' => Faculty::active()->where('course_id', $course->id)->ordered()->get(),
            'results' => Result::publishable()->where('course_id', $course->id)->ordered()->take(4)->get(),
            'batches' => Batch::upcoming()->ordered()
                ->whereHas('courseLevel', fn ($q) => $q->where('course_id', $course->id))
                ->with('courseLevel')->get(),
        ]);
    }

    public function destination(Destination $destination)
    {
        abort_unless($destination->is_active, 404);

        $destination->load(['scholarships' => fn ($q) => $q->where('is_active', true)]);

        return view('destinations.show', [
            'destination' => $destination,
            'processSteps' => $destination->processSteps->isNotEmpty()
                ? $destination->processSteps
                : ProcessStep::generic()->ordered()->get(),
            'partners' => $destination->partners()->where('is_verified', true)->orderBy('sort')->get(),
            'letters' => AcceptanceLetter::publishable()->where('destination_id', $destination->id)->ordered()->get(),
            'faqs' => Faq::active()->forScope('destination')->where('destination_id', $destination->id)->ordered()->get(),
            'courses' => Course::active()->ordered()->get(),
        ]);
    }

    public function scholarships()
    {
        return view('scholarships', [
            'destinations' => Destination::active()->ordered()
                ->with(['scholarships' => fn ($q) => $q->where('is_active', true)->orderBy('sort')])
                ->get(),
            'courses' => Course::active()->ordered()->get(),
        ]);
    }

    public function stories()
    {
        return view('stories', [
            'results' => Result::publishable()->ordered()->get(),
            'videoStories' => Testimonial::publishable()->ofType('video')->ordered()->get(),
            'reviews' => Testimonial::publishable()->ofType('written')->ordered()->get(),
            'alumni' => Testimonial::publishable()->ofType('alumni')->ordered()->get(),
            'letters' => AcceptanceLetter::publishable()->ordered()->with('destination')->get(),
            'courses' => Course::active()->ordered()->get(),
        ]);
    }

    public function post(Post $post)
    {
        abort_if($post->published_at === null || $post->published_at->isFuture(), 404);

        return view('blog.show', [
            'post' => $post->load('category'),
            'related' => Post::published()
                ->where('id', '!=', $post->id)
                ->when($post->post_category_id, fn ($q) => $q->where('post_category_id', $post->post_category_id))
                ->latestFirst()->with('category')->take(3)->get(),
            'courses' => Course::active()->ordered()->get(),
        ]);
    }

    public function page(Page $page)
    {
        abort_unless($page->is_active, 404);

        return view('page', [
            'page' => $page,
            'courses' => Course::active()->ordered()->get(),
        ]);
    }
}
