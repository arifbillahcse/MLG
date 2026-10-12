@extends('layouts.app')

@section('title', $destination->meta_title ?: $destination->name.' — Multi Languages Gateway')
@section('description', $destination->meta_description ?: $destination->intro)

@section('content')
<section class="page-head">
  <div class="wrap">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span aria-hidden="true">/</span>
      <a href="{{ route('home') }}#destinations">Study Abroad</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">{{ $destination->name }}</span>
    </nav>
    <p class="eyebrow reveal">{{ $destination->flag }} Study abroad</p>
    <h1 class="reveal" data-delay="1">{{ $destination->t('name') }}</h1>
    <p class="page-head__lede reveal" data-delay="2">{{ $destination->t('intro') }}</p>

    <div class="hero__actions reveal" data-delay="3" style="margin-top:var(--s6);margin-bottom:0">
      <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">Book a free consultation</a>
      <a href="#scholarships" class="btn btn--ghost btn--lg">See scholarships</a>
    </div>
  </div>
</section>

@if ($destination->highlights)
<section class="section" id="overview">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">What we handle</p>
      <h2>End to end, in house</h2>
    </header>
    <div class="steps">
      @foreach ($destination->highlights as $i => $highlight)
        <article class="step reveal" data-delay="{{ $i + 1 }}">
          <span class="step__no">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
          <h3>{{ $highlight }}</h3>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif

@if ($destination->universities)
<section class="section section--band" id="universities">
  <div class="wrap wrap--narrow">
    <header class="sec-head reveal">
      <p class="eyebrow">Institutions</p>
      <h2>Universities and colleges</h2>
    </header>
    <div class="fee-table reveal" data-delay="1">
      <p class="chairman__text">{!! nl2br(e($destination->universities)) !!}</p>
    </div>
  </div>
</section>
@endif

<section class="section section--dark" id="process">
  <div class="wrap">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow eyebrow--light">The process</p>
      <h2>How the application runs</h2>
    </header>
    <ol class="timeline">
      @foreach ($processSteps as $i => $step)
        <li class="timeline__step reveal" data-delay="{{ $i + 1 }}">
          <span class="timeline__dot{{ $loop->last ? ' timeline__dot--end' : '' }}"></span>
          <span class="timeline__month mono">{{ $step->step_label }}</span>
          <h3>{{ $step->t('title') }}</h3>
          <p>{{ $step->t('body') }}</p>
        </li>
      @endforeach
    </ol>
  </div>
</section>

@if ($destination->scholarships->isNotEmpty())
<section class="section" id="scholarships">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Funding</p>
      <h2>Scholarships for {{ Str::after($destination->name, 'Study in ') }}</h2>
      <p class="sec-head__lede">Most close months before the admission deadline and are far more competitive than the admission itself. We will tell you frankly whether your profile is realistic.</p>
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
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif

@if ($destination->visa_guidance)
<section class="section section--band" id="visa">
  <div class="wrap wrap--narrow">
    <header class="sec-head reveal">
      <p class="eyebrow">Visa</p>
      <h2>Visa guidance</h2>
    </header>
    <div class="fee-table reveal" data-delay="1">
      <p class="chairman__text">{!! nl2br(e($destination->visa_guidance)) !!}</p>
    </div>
  </div>
</section>
@endif

@if ($letters->isNotEmpty())
<section class="section" id="letters">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Proof</p>
      <h2>Offer letters from {{ Str::after($destination->name, 'Study in ') }}</h2>
    </header>
    <div class="letters">
      @foreach ($letters as $i => $letter)
        <article class="letter reveal" data-delay="{{ $i + 1 }}">
          <div class="letter__redact" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span></div>
          <p class="letter__uni">{{ $letter->university }}</p>
          <p class="letter__meta">{{ $letter->intake }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif

@if ($partners->isNotEmpty())
<section class="section section--tight">
  <div class="wrap">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow">Placements</p>
      <h2>Where our students go</h2>
    </header>
  </div>
  <div class="marquee" aria-label="Partner institutions">
    <div class="marquee__track">
      @foreach ($partners as $partner)
        <span class="marquee__item">{{ $partner->name }}</span>
      @endforeach
      @foreach ($partners as $partner)
        <span class="marquee__item" aria-hidden="true">{{ $partner->name }}</span>
      @endforeach
    </div>
  </div>
</section>
@endif

@if ($faqs->isNotEmpty())
<section class="section section--band" id="faq">
  <div class="wrap wrap--narrow">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow">FAQ</p>
      <h2>About studying in {{ Str::after($destination->name, 'Study in ') }}</h2>
    </header>
    <div class="faq">
      @foreach ($faqs as $faq)
        <div class="faq__item reveal">
          <button type="button" class="faq__q" aria-expanded="false">
            <span>{{ $faq->t('question') }}</span>
            <span class="faq__icon" aria-hidden="true"></span>
          </button>
          <div class="faq__a"><p>{{ $faq->t('answer') }}</p></div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

@include('partials.cta', ['formId' => 'destinationLead', 'formSlug' => 'consultation'])
@endsection
