@extends('layouts.app')

@section('title', 'Scholarships for Japan, Korea and China — Multi Languages Gateway')
@section('description', 'MEXT, GKS, CSC and university scholarships for Bangladeshi students, with the deadlines that actually decide your timeline.')

@section('content')
<section class="page-head">
  <div class="wrap">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">Scholarships</span>
    </nav>
    <p class="eyebrow reveal">Funding</p>
    <h1 class="reveal" data-delay="1">Scholarships, and who actually gets them</h1>
    <p class="page-head__lede reveal" data-delay="2">Scholarship deadlines close months before admission deadlines, which is why most students miss them. We plan backwards from the award, not from the intake. And we will tell you plainly if your profile is not competitive for one.</p>
  </div>
</section>

@foreach ($destinations as $destination)
  @if ($destination->scholarships->isNotEmpty())
  <section class="section{{ $loop->odd ? '' : ' section--band' }}" id="{{ $destination->slug }}">
    <div class="wrap">
      <header class="sec-head reveal">
        <p class="eyebrow">{{ $destination->flag }} {{ Str::after($destination->name, 'Study in ') }}</p>
        <h2>Awards for {{ Str::after($destination->name, 'Study in ') }}</h2>
      </header>
      <div class="certs">
        @foreach ($destination->scholarships as $i => $scholarship)
          <article class="cert reveal" data-delay="{{ $i + 1 }}">
            <span class="cert__seal"><svg viewBox="0 0 24 24" class="ic"><circle cx="12" cy="8" r="5"/><path d="m8.5 12.5-1.5 8 5-3 5 3-1.5-8"/></svg></span>
            <div>
              <h3>{{ $scholarship->name }}</h3>
              <p>{{ $scholarship->description }}</p>
              @if ($scholarship->deadline_note)
                <p class="cert__ref">{{ $scholarship->deadline_note }}</p>
              @endif
              @if ($scholarship->url)
                <p class="cert__ref"><a href="{{ $scholarship->url }}" target="_blank" rel="noopener">Official information →</a></p>
              @endif
            </div>
          </article>
        @endforeach
      </div>
      <p class="partners__note" style="text-align:left;margin-top:var(--s5)">
        <a href="{{ route('destinations.show', $destination) }}">Full guide to {{ $destination->name }} →</a>
      </p>
    </div>
  </section>
  @endif
@endforeach

@include('partials.cta', [
  'formId' => 'scholarshipLead',
  'formSlug' => 'consultation',
  'ctaHeading' => 'Find out if you are competitive',
  'ctaBody' => 'Bring your transcripts and we will tell you honestly which awards are worth your time and which are not. That answer is free, and it saves people months.',
])
@endsection
