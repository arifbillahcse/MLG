@extends('layouts.app')

@section('title', 'Success Stories — Multi Languages Gateway')
@section('description', 'Top JLPT, TOPIK, HSK and IELTS scores, video testimonials, written reviews and offer letters from MLG students who are now studying in Japan, Korea and China.')

@section('content')
<section class="page-head">
  <div class="wrap">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">Success Stories</span>
    </nav>
    <p class="eyebrow reveal">Proof, not promises</p>
    <h1 class="reveal" data-delay="1">Students who already flew</h1>
    <p class="page-head__lede reveal" data-delay="2">Every score, letter and quote on this page is published with the student's permission. Ask at the office and we will show you the originals.</p>
  </div>
</section>

@if ($results->isNotEmpty())
<section class="section" id="results">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Top scores</p>
      <h2>Exam results</h2>
    </header>
    <div class="results">
      @foreach ($results as $i => $result)
        <div class="result reveal" data-delay="{{ intdiv($i, 2) + 1 }}">
          <span class="result__exam">{{ $result->exam }}</span>
          <p class="result__score">{{ $result->score }}</p>
          <p class="result__name">{{ $result->student_name }}</p>
          <p class="result__meta">{{ $result->meta }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

@if ($videoStories->isNotEmpty())
<section class="section section--band" id="videos">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">In their words</p>
      <h2>Video testimonials</h2>
    </header>
    <div class="posts">
      @foreach ($videoStories as $i => $story)
        <article class="vcard reveal" data-delay="{{ $i + 1 }}">
          <div class="vcard__thumb vcard__thumb--{{ $story->thumb_variant ?: '1' }}">
            <button type="button" class="vcard__play" aria-label="Play testimonial from {{ $story->student_name }}"
                    @if ($story->video_url) data-video="{{ $story->video_url }}" @endif>
              <svg viewBox="0 0 24 24" class="ic ic--fill"><path d="M8 5v14l11-7z"/></svg>
            </button>
          </div>
          <h3>{{ $story->student_name }}</h3>
          <p class="vcard__meta">{{ $story->meta }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif

@if ($reviews->isNotEmpty())
<section class="section" id="reviews">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Written reviews</p>
      <h2>What students say</h2>
      <p class="sec-head__lede">{{ \App\Support\Site::get('google_rating') }} stars from {{ \App\Support\Site::get('google_reviews') }} Google reviews.</p>
    </header>
    <div class="certs">
      @foreach ($reviews as $i => $review)
        <article class="cert reveal" data-delay="{{ $i + 1 }}">
          <span class="cert__seal"><svg viewBox="0 0 24 24" class="ic"><path d="M21 14a2 2 0 0 1-2 2H8l-4 4V5a2 2 0 0 1 2-2h13a2 2 0 0 1 2 2z"/></svg></span>
          <div>
            <p>{{ $review->quote }}</p>
            <p class="cert__ref">{{ $review->student_name }} · {{ $review->meta }}</p>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif

@if ($alumni->isNotEmpty())
<section class="section section--band" id="alumni">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Alumni</p>
      <h2>Interviews with students abroad</h2>
    </header>
    <div class="posts">
      @foreach ($alumni as $i => $story)
        <article class="vcard reveal" data-delay="{{ $i + 1 }}">
          <div class="vcard__thumb vcard__thumb--{{ $story->thumb_variant ?: '2' }}">
            <button type="button" class="vcard__play" aria-label="Play interview with {{ $story->student_name }}">
              <svg viewBox="0 0 24 24" class="ic ic--fill"><path d="M8 5v14l11-7z"/></svg>
            </button>
          </div>
          <h3>{{ $story->student_name }}</h3>
          <p class="vcard__meta">{{ $story->meta }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif

@if ($letters->isNotEmpty())
<section class="section" id="letters">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Offer letters</p>
      <h2>Acceptances our students received</h2>
      <p class="sec-head__lede">Names and student numbers redacted.</p>
    </header>
    <div class="letters">
      @foreach ($letters as $i => $letter)
        <article class="letter reveal" data-delay="{{ $i + 1 }}">
          <div class="letter__redact" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span></div>
          <p class="letter__uni">{{ $letter->university }}</p>
          <p class="letter__meta">{{ $letter->destination?->flag }} {{ $letter->intake }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif

@include('partials.cta', [
  'formId' => 'storiesLead',
  'formSlug' => 'consultation',
  'ctaHeading' => 'Your story could be on this page',
  'ctaBody' => 'Every student here started with a free consultation and an honest answer about what was realistic. Book yours.',
])
@endsection
