<!-- ═══════════════ FOOTER ═══════════════ -->
<footer class="footer">
  <div class="wrap footer__grid">
    <div class="footer__brand">
      <a href="#" class="logo logo--light">
        <span class="logo__mark" aria-hidden="true">
          <img src="{{ asset('assets/img/glm-logo-132.png') }}" width="152" height="132" alt="Multi Languages Gateway" decoding="async">
        </span>
    </a>
      <p class="footer__about">Dhaka language institute and study-abroad consultancy. Japanese, Korean, Chinese and IELTS — online or in class — with admission, scholarship and visa support for Japan, Korea and China.</p>
      <div class="socials socials--footer">
        <a href="{{ $settings['facebook'] ?? '#' }}" aria-label="Facebook"><svg viewBox="0 0 24 24" class="ic ic--fill"><path d="M14 9h3V6h-3c-2 0-3.5 1.6-3.5 3.5V12H8v3h2.5v7h3v-7H16l.5-3h-3v-2c0-.6.4-1 .5-1z"/></svg></a>
        <a href="{{ $settings['youtube'] ?? '#' }}" aria-label="Youtube"><svg viewBox="0 0 24 24" class="ic ic--fill"><path d="M22 12s0-3-.4-4.4a2.5 2.5 0 0 0-1.8-1.8C18.4 5.4 12 5.4 12 5.4s-6.4 0-8 .4a2.5 2.5 0 0 0-1.7 1.8C2 9 2 12 2 12s0 3 .4 4.4A2.5 2.5 0 0 0 4 18.2c1.6.4 8 .4 8 .4s6.4 0 8-.4a2.5 2.5 0 0 0 1.7-1.8C22 15 22 12 22 12zM10 15V9l5 3z"/></svg></a>
        <a href="{{ $settings['instagram'] ?? '#' }}" aria-label="Instagram"><svg viewBox="0 0 24 24" class="ic"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="3.5"/><circle cx="17.2" cy="6.8" r="1.2" fill="currentColor" stroke="none"/></svg></a>
        <a href="{{ $settings['linkedin'] ?? '#' }}" aria-label="Linkedin"><svg viewBox="0 0 24 24" class="ic ic--fill"><path d="M6.5 8H4v12h2.5zM5.2 3.5a1.7 1.7 0 1 0 0 3.4 1.7 1.7 0 0 0 0-3.4zM20 13.2c0-3.2-1.7-4.7-4-4.7a3.5 3.5 0 0 0-3.1 1.7V8.8H10.4V20H13v-6c0-1.6.8-2.5 2-2.5s2 .9 2 2.5v6h3z"/></svg></a>
      </div>
    </div>

    <nav class="footer__col" aria-label="Courses">
      <h3>Courses</h3>
      @foreach ($navCourses as $navCourse)
        <a href="{{ route('courses.japanese') }}">{{ $navCourse->name }}@if ($navCourse->exam_name) — {{ $navCourse->exam_name }}@endif</a>
      @endforeach
      <a href="{{ route('home') }}#modes">Online vs in class</a>
    </nav>

    <nav class="footer__col" aria-label="Destinations">
      <h3>Study abroad</h3>
      @foreach ($navDestinations as $navDestination)
        <a href="{{ route('home') }}#destinations">{{ $navDestination->flag }} {{ $navDestination->name }}</a>
      @endforeach
      <a href="{{ route('home') }}#destinations">Scholarships</a>
      <a href="{{ route('home') }}#mock">Free mock test</a>
    </nav>

    <div class="footer__col footer__col--contact">
      <h3>Dhaka office</h3>
      <address>
        {{ $settings['address_line1'] ?? '' }}<br>
        {{ $settings['address_line2'] ?? '' }}
      </address>
      <a href="tel:{{ $settings['phone_raw'] ?? '' }}" class="footer__contact mono">{{ $settings['phone'] ?? '' }}</a>
      <a href="mailto:{{ $settings['email'] ?? '' }}" class="footer__contact">{{ $settings['email'] ?? '' }}</a>
      <p class="footer__hours">{{ $settings['office_hours'] ?? '' }}</p>
    </div>
  </div>

  <div class="wrap footer__bottom">
    <p>© {{ date('Y') }} {{ $settings['site_name'] ?? 'Multi Languages Gateway' }}. All rights reserved.</p>
    <p class="footer__legal"><a href="#">Privacy policy</a> · <a href="#">Terms</a> · <a href="#">Refund policy</a></p>
  </div>
</footer>

<!-- floating actions -->
<a class="wa" href="https://wa.me/{{ $settings['whatsapp'] ?? '' }}" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
  <svg viewBox="0 0 24 24" class="ic ic--fill"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm5.6 14.1c-.2.7-1.2 1.3-1.9 1.4-.5.1-1.1.2-3.2-.7-2.7-1.1-4.4-3.9-4.5-4-.1-.2-1.1-1.4-1.1-2.7s.7-1.9 1-2.2c.2-.2.5-.3.7-.3h.5c.2 0 .4 0 .6.5l.8 2c.1.2.1.3 0 .5l-.4.5-.3.3c-.1.1-.2.3-.1.5.2.3.7 1.2 1.5 1.9 1 .9 1.8 1.1 2 1.2.2.1.4.1.5-.1l.8-.9c.2-.2.3-.2.5-.1l2 .9c.2.1.4.2.4.3.1.2.1.7-.1 1.4z"/></svg>
</a>

<div class="mobile-bar">
  <a href="tel:{{ $settings['phone_raw'] ?? '' }}" class="mobile-bar__btn mobile-bar__btn--call">
    <svg viewBox="0 0 24 24" class="ic"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.2a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg>
    Call now
  </a>
  <a href="https://wa.me/{{ $settings['whatsapp'] ?? '' }}" target="_blank" rel="noopener" class="mobile-bar__btn mobile-bar__btn--wa">
    <svg viewBox="0 0 24 24" class="ic ic--fill"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm5.6 14.1c-.2.7-1.2 1.3-1.9 1.4-.5.1-1.1.2-3.2-.7-2.7-1.1-4.4-3.9-4.5-4-.1-.2-1.1-1.4-1.1-2.7s.7-1.9 1-2.2c.2-.2.5-.3.7-.3h.5c.2 0 .4 0 .6.5l.8 2c.1.2.1.3 0 .5l-.4.5-.3.3c-.1.1-.2.3-.1.5.2.3.7 1.2 1.5 1.9 1 .9 1.8 1.1 2 1.2.2.1.4.1.5-.1l.8-.9c.2-.2.3-.2.5-.1l2 .9c.2.1.4.2.4.3.1.2.1.7-.1 1.4z"/></svg>
    WhatsApp
  </a>
</div>

<button type="button" class="totop" id="totop" aria-label="Back to top">
  <svg viewBox="0 0 24 24" class="ic"><path d="m18 15-6-6-6 6"/></svg>
</button>
