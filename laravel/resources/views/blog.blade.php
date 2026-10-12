@extends('layouts.app')

@section('title', 'Blog — Multi Languages Gateway')
@section('description', 'Straight answers about studying in Japan: COE rejection reasons, real cost of living, JLPT planning, part-time work rules and IELTS band strategy.')

@section('og')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Blog — Multi Languages Gateway">
    <meta property="og:description" content="Straight answers about studying in Japan: COE rejection reasons, real cost of living, JLPT planning, part-time work rules and IELTS band strategy.">
@endsection

@section('content')
<section class="page-head">
  <div class="wrap">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">Blog</span>
    </nav>
    <h1 class="reveal" data-en="Read before you decide" data-bn="সিদ্ধান্ত নেওয়ার আগে পড়ুন">Read before you decide</h1>
    <p class="page-head__lede reveal" data-delay="1">Straight answers about studying in Japan — real costs, real timelines, and the reasons applications actually get rejected. Written by the counsellors who file these applications every intake.</p>
  </div>
</section>

<section class="section">
  <div class="wrap">

    <div class="chips reveal" role="group" aria-label="Filter posts by topic">
      <button type="button" class="chip is-active" data-filter="all">All posts</button>
      @foreach ($categories as $category)
        <button type="button" class="chip" data-filter="{{ $category->slug }}">{{ $category->name }}</button>
      @endforeach
    </div>

    @if ($featured)
    <article class="featured reveal" data-cat="{{ $featured->category?->slug }}">
      <div class="featured__thumb"
           @if ($featured->thumbnail) style="background-image:url('{{ asset('storage/'.$featured->thumbnail) }}');background-size:cover" @endif></div>
      <div>
        <span class="featured__tag">Featured · {{ $featured->category?->name }}</span>
        <h2><a href="{{ route('blog') }}">{{ $featured->title }}</a></h2>
        <p class="featured__meta">{{ $featured->read_minutes }} min read · {{ $featured->published_at?->diffForHumans() }}</p>
        <p>{{ $featured->excerpt }}</p>
        <a href="{{ route('blog') }}" class="btn btn--primary btn--sm">Read the guide</a>
      </div>
    </article>
    @endif

    <div class="posts" id="postGrid">
      @foreach ($posts as $i => $post)
      <article class="post reveal" data-delay="{{ ($i % 3) + 1 }}" data-cat="{{ $post->category?->slug }}">
        <div class="post__thumb post__thumb--{{ $post->thumb_variant ?: '1' }}"
             @if ($post->thumbnail) style="background-image:url('{{ asset('storage/'.$post->thumbnail) }}');background-size:cover" @endif>
          <span class="post__cat">{{ $post->category?->name }}</span>
        </div>
        <h3><a href="{{ route('blog') }}">{{ $post->title }}</a></h3>
        <p class="post__excerpt">{{ $post->excerpt }}</p>
        <p class="post__meta mono">{{ $post->read_minutes }} min read · {{ $post->category?->name }}</p>
      </article>
      @endforeach
    </div>

    <p class="blog-empty" id="blogEmpty" hidden>No posts in this topic yet.</p>

    <nav class="pagination" aria-label="Pagination">
      {{ $posts->onEachSide(1)->links() }}
    </nav>

  </div>
</section>

<section class="cta">
  <canvas class="cta__stars" id="ctaStars" aria-hidden="true"></canvas>
  <div class="wrap cta__inner">
    <div class="cta__copy reveal">
      <p class="eyebrow eyebrow--gold">Still have a question?</p>
      <h2>An article can't read your documents</h2>
      <p>Bring your certificates, your bank statement and your target intake to a free 30-minute session. We'll tell you honestly whether the application stands up — and what to fix if it doesn't.</p>
      <ul class="cta__points">
        <li>Written cost estimate on the day</li>
        <li>Honest answer if Japan isn't right for you</li>
        <li>Bangla or English, whichever you prefer</li>
      </ul>
    </div>

    <form class="cta__form reveal" data-delay="1" id="blogLeadForm" method="POST" action="{{ route('enquiry.store') }}" data-lead novalidate>
        @include('partials.form.head', ['form' => 'consultation'])
      <div class="field">
        <label for="b-name">Full name</label>
        <input type="text" id="b-name" name="name" @error('name') aria-invalid="true" @enderror required autocomplete="name" placeholder="Your name" value="{{ old('name') }}">
      </div>
      <div class="field">
        <label for="b-phone">Mobile number</label>
        <input type="tel" id="b-phone" name="phone" @error('phone') aria-invalid="true" @enderror required autocomplete="tel" inputmode="tel" placeholder="01XXXXXXXXX" value="{{ old('phone') }}">
      </div>
      <div class="field">
        <label for="b-interest">I want to talk about</label>
        <select id="b-interest" name="interest">
          @foreach ($courses as $course)
            <option>{{ $course->name }}@if ($course->exam_name) ({{ $course->exam_name }})@endif</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn--gold btn--block btn--lg">Book my free session</button>
      @include('partials.form.status', ['form' => 'consultation'])
      <p class="cta__privacy">We call once. No spam, no selling your number.</p>
    </form>
  </div>
</section>
@endsection
