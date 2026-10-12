@extends('layouts.app')

@section('title', 'Contact — Multi Languages Gateway')
@section('description', 'Talk to an MLG counsellor in Dhaka about Japanese language courses, IELTS preparation or a Japan student visa. Free 30-minute session, written roadmap included.')

@section('og')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Contact — Multi Languages Gateway">
    <meta property="og:description" content="Talk to an MLG counsellor in Dhaka about Japanese language courses, IELTS preparation or a Japan student visa. Free 30-minute session, written roadmap included.">
@endsection

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "{{ \App\Support\Site::get('site_name', 'Multi Languages Gateway') }}",
  "url": "https://example.com/",
  "telephone": "{{ \App\Support\Site::get('phone_raw') }}",
  "email": "{{ \App\Support\Site::get('email') }}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ \App\Support\Site::get('address_line1') }}",
    "addressLocality": "Dhaka",
    "postalCode": "1205",
    "addressCountry": "BD"
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": ["Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday"],
    "opens": "10:00",
    "closes": "20:00"
  }
}
</script>
@endpush

@section('content')
<section class="page-head">
  <div class="wrap">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">Contact</span>
    </nav>
    <h1 class="reveal" data-en="Talk to a counsellor" data-bn="কাউন্সেলরের সাথে কথা বলুন">Talk to a counsellor</h1>
    <p class="page-head__lede reveal" data-delay="1">Come to the office, call, or send the form below. Whichever you pick, you get the same thing: a written roadmap with your language timeline, target intake, visa window and total cost — free, and yours to keep whether you enrol or not.</p>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div class="contact">

      <div class="info reveal">
        <div class="info__card">
          <span class="info__icon info__icon--red">
            <svg viewBox="0 0 24 24" class="ic"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </span>
          <div>
            <h3>Dhaka office</h3>
            <address>
              {{ $settings['address_line1'] ?? '' }}<br>
              {{ $settings['address_line2'] ?? '' }}
            </address>
          </div>
        </div>

        <div class="info__card">
          <span class="info__icon info__icon--red">
            <svg viewBox="0 0 24 24" class="ic"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.2a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg>
          </span>
          <div>
            <h3>Phone &amp; WhatsApp</h3>
            <p>
              <a href="tel:{{ $settings['phone_raw'] ?? '' }}" class="mono">{{ $settings['phone'] ?? '' }}</a><br>
              <a href="https://wa.me/{{ $settings['whatsapp'] ?? '' }}" target="_blank" rel="noopener">Message us on WhatsApp</a>
            </p>
          </div>
        </div>

        <div class="info__card">
          <span class="info__icon info__icon--teal">
            <svg viewBox="0 0 24 24" class="ic"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
          </span>
          <div>
            <h3>Email</h3>
            <p><a href="mailto:{{ $settings['email'] ?? '' }}">{{ $settings['email'] ?? '' }}</a></p>
          </div>
        </div>

        <div class="info__card">
          <span class="info__icon info__icon--gold">
            <svg viewBox="0 0 24 24" class="ic"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg>
          </span>
          <div>
            <h3>Office hours</h3>
            <p>{{ $settings['office_hours'] ?? '' }}</p>
          </div>
        </div>
      </div>

      <form class="contact__form reveal" data-delay="1" id="contactForm" data-lead novalidate>
        <h2>Send us a message</h2>
        <p>We reply within one working day. If it's urgent, call instead.</p>

        <div class="field-row">
          <div class="field">
            <label for="k-name">Full name</label>
            <input type="text" id="k-name" name="name" required autocomplete="name" placeholder="Your name">
          </div>
          <div class="field">
            <label for="k-phone">Mobile number</label>
            <input type="tel" id="k-phone" name="phone" required autocomplete="tel" inputmode="tel" placeholder="01XXXXXXXXX">
          </div>
        </div>

        <div class="field">
          <label for="k-email">Email <span style="color:var(--slate-light);font-weight:400">(optional)</span></label>
          <input type="email" id="k-email" name="email" autocomplete="email" placeholder="you@example.com">
        </div>

        <div class="field">
          <label for="k-interest">What can we help with?</label>
          <select id="k-interest" name="interest">
            @foreach ($courses as $course)
              <option>{{ $course->name }}@if ($course->exam_name) ({{ $course->exam_name }})@endif</option>
            @endforeach
            @foreach ($destinations as $destination)
              <option>{{ $destination->name }}</option>
            @endforeach
            <option>Something else</option>
          </select>
        </div>

        <div class="field">
          <label for="k-message">Your message</label>
          <textarea id="k-message" name="message" placeholder="Tell us where you are today — your last qualification, budget and the intake you're aiming for."></textarea>
        </div>

        <button type="submit" class="btn btn--primary btn--block btn--lg">Send message</button>
        <p class="form__status" role="status" aria-live="polite"></p>
      </form>

    </div>
  </div>
</section>

<section class="section section--band">
  <div class="wrap">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow">Find us</p>
      <h2>Dhanmondi, Dhaka</h2>
      <p class="sec-head__lede">Two minutes from Dhanmondi 27. Walk-ins welcome during office hours, though a booked slot means a counsellor is waiting for you.</p>
    </header>

    @if (!empty($settings['map_embed']))
      <div class="map reveal" data-delay="1" style="padding:0">{!! $settings['map_embed'] !!}</div>
    @else
      <div class="map reveal" data-delay="1">
        <div>
          <span class="map__pin">
            <svg viewBox="0 0 24 24" class="ic"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </span>
          <p><b>Map not set</b><br>Paste a Google Maps embed into Site settings.</p>
        </div>
      </div>
    @endif
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow">After you get in touch</p>
      <h2>What happens next</h2>
    </header>

    <div class="steps">
      <article class="step reveal" data-delay="1">
        <span class="step__no">01</span>
        <h3>We call you back</h3>
        <p>Within one working day, on the number you gave us. One call — we don't chase people.</p>
      </article>
      <article class="step reveal" data-delay="2">
        <span class="step__no">02</span>
        <h3>Book a free session</h3>
        <p>Thirty minutes at the office, or on the phone if you're outside Dhaka.</p>
      </article>
      <article class="step reveal" data-delay="3">
        <span class="step__no">03</span>
        <h3>You get a written plan</h3>
        <p>Language level, exam date, application window, visa timeline and total cost, on paper.</p>
      </article>
      <article class="step reveal" data-delay="4">
        <span class="step__no">04</span>
        <h3>You decide</h3>
        <p>Enrol, think about it, or take the plan elsewhere. No deposit, no pressure.</p>
      </article>
    </div>
  </div>
</section>
@endsection
