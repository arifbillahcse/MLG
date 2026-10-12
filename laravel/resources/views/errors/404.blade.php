@extends('layouts.app')

@section('title', 'Page not found — Multi Languages Gateway')
@section('description', 'That page does not exist.')

@section('content')
<section class="page-head" style="border-bottom:none">
  <div class="wrap wrap--narrow" style="text-align:center;padding:var(--s9) 0">
    <p class="eyebrow">404</p>
    <h1>We cannot find that page</h1>
    <p class="page-head__lede" style="margin:0 auto">It may have moved, or the link may be wrong. These are the pages people usually want:</p>

    <div class="hero__actions" style="justify-content:center;margin-top:var(--s7)">
      <a href="{{ route('home') }}" class="btn btn--primary btn--lg">Home</a>
      <a href="{{ route('contact') }}" class="btn btn--ghost btn--lg">Contact us</a>
    </div>
  </div>
</section>
@endsection
