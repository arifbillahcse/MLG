@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title.' | MLG Blog')
@section('description', $post->meta_description ?: $post->excerpt)

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BlogPosting",
  "headline": {!! json_encode($post->title) !!},
  "description": {!! json_encode($post->excerpt) !!},
  "datePublished": "{{ $post->published_at?->toIso8601String() }}",
  "dateModified": "{{ $post->updated_at?->toIso8601String() }}",
  "publisher": {
    "@@type": "Organization",
    "name": "{{ \App\Support\Site::get('site_name', 'Multi Languages Gateway') }}"
  }
}
</script>
@endpush

@section('content')
<section class="page-head">
  <div class="wrap wrap--narrow">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span aria-hidden="true">/</span>
      <a href="{{ route('blog') }}">Blog</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">{{ $post->category?->name }}</span>
    </nav>
    <p class="eyebrow reveal">{{ $post->category?->name }}</p>
    <h1 class="reveal" data-delay="1">{{ $post->title }}</h1>
    <p class="post__meta mono reveal" data-delay="2" style="margin-top:var(--s4)">
      {{ $post->published_at?->format('j F Y') }}
      @if ($post->read_minutes) · {{ $post->read_minutes }} min read @endif
    </p>
  </div>
</section>

<section class="section">
  <div class="wrap wrap--narrow">
    @if ($post->excerpt)
      <p class="sec-head__lede reveal" style="font-size:19px;margin-bottom:var(--s6)">{{ $post->excerpt }}</p>
    @endif

    <div class="prose reveal" data-delay="1">
      @if ($post->body)
        {!! $post->body !!}
      @else
        <p>This article is being written. In the meantime, book a free consultation and we
        will answer the question directly.</p>
      @endif
    </div>
  </div>
</section>

@if ($related->isNotEmpty())
<section class="section section--band">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Keep reading</p>
      <h2>More on {{ $post->category?->name ?? 'the blog' }}</h2>
    </header>
    <div class="posts">
      @foreach ($related as $i => $other)
        <article class="post reveal" data-delay="{{ $i + 1 }}">
          <div class="post__thumb post__thumb--{{ $other->thumb_variant ?: '1' }}">
            <span class="post__cat">{{ $other->category?->name }}</span>
          </div>
          <h3><a href="{{ route('blog.show', $other) }}">{{ $other->title }}</a></h3>
          <p class="post__meta mono">{{ $other->read_minutes }} min read</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif

@include('partials.cta', ['formId' => 'postLead', 'formSlug' => 'consultation'])
@endsection
