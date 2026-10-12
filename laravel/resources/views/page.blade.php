@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title.' — Multi Languages Gateway')
@section('description', $page->meta_description ?: '')

@section('content')
<section class="page-head">
  <div class="wrap wrap--narrow">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">{{ $page->title }}</span>
    </nav>
    <h1 class="reveal">{{ $page->title }}</h1>
    <p class="page-head__lede reveal" data-delay="1">Last updated {{ $page->updated_at?->format('j F Y') }}.</p>
  </div>
</section>

<section class="section">
  <div class="wrap wrap--narrow">
    <div class="prose reveal">
      {!! $page->body !!}
    </div>
  </div>
</section>
@endsection
