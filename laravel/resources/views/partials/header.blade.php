<!-- ═══════════════ 02 · STICKY HEADER ═══════════════ -->
<header class="header" id="header">
  <div class="wrap header__inner">
    <a href="{{ route('home') }}" class="logo" aria-label="Multi Languages Gateway home">
      <span class="logo__mark" aria-hidden="true">
        <img src="{{ asset('assets/img/glm-logo-132.png') }}" width="152" height="132" alt="Multi Languages Gateway" decoding="async">
      </span>
    </a>

    <nav class="nav" id="nav" aria-label="Main">
      <div class="nav__head">
        <span class="nav__head-title">Menu</span>
        <button type="button" class="nav__close" id="navClose" aria-label="Close menu">
          <svg viewBox="0 0 24 24" class="ic"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
      </div>

      <ul class="nav__list">
        <li class="nav__item has-sub">
          <button type="button" class="nav__link" aria-expanded="false">
            <span data-en="Language Courses" data-bn="ভাষা কোর্স">Language Courses</span>
            <svg viewBox="0 0 24 24" class="caret" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <div class="submenu submenu--jp">
            <ul>
              @foreach ($navCourses as $navCourse)
                <li><a href="{{ route('courses.japanese') }}">{{ $navCourse->name }}@if ($navCourse->exam_name) — {{ $navCourse->exam_name }}@endif</a></li>
              @endforeach
              <li><a href="{{ route('home') }}#modes">Online vs In-class</a></li>
              <li><a href="{{ route('home') }}#mock">Book a mock test</a></li>
            </ul>
          </div>
        </li>

        <li class="nav__item has-sub">
          <button type="button" class="nav__link" aria-expanded="false">
            <span data-en="Study Abroad" data-bn="বিদেশে পড়াশোনা">Study Abroad</span>
            <svg viewBox="0 0 24 24" class="caret" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <div class="submenu submenu--gl">
            <ul>
              @foreach ($navDestinations as $navDestination)
                <li><a href="{{ route('home') }}#destinations"><span class="flag">{{ $navDestination->flag }}</span> {{ $navDestination->name }}</a></li>
              @endforeach
              <li><a href="{{ route('home') }}#destinations">Scholarships</a></li>
              <li><a href="{{ route('home') }}#destinations">Visa guidance</a></li>
              <li><a href="{{ route('contact') }}">Book a 1-on-1 consultation</a></li>
            </ul>
          </div>
        </li>

        <li class="nav__item has-sub">
          <button type="button" class="nav__link" aria-expanded="false">
            <span data-en="Success Stories" data-bn="সাফল্যের গল্প">Success Stories</span>
            <svg viewBox="0 0 24 24" class="caret" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <div class="submenu submenu--gl">
            <ul>
              <li><a href="#">Top scores</a></li>
              <li><a href="#">Video testimonials</a></li>
              <li><a href="#">Written reviews</a></li>
              <li><a href="#">Acceptance letters</a></li>
              <li><a href="#">Alumni interviews</a></li>
            </ul>
          </div>
        </li>

        <li class="nav__item has-sub">
          <button type="button" class="nav__link" aria-expanded="false">
            <span data-en="About Us" data-bn="আমাদের সম্পর্কে">About Us</span>
            <svg viewBox="0 0 24 24" class="caret" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <div class="submenu submenu--jp">
            <ul>
              <li><a href="{{ route('about') }}">Who we are</a></li>
              <li><a href="{{ route('about') }}#mission">Mission &amp; vision</a></li>
              <li><a href="{{ route('about') }}#team">Our team</a></li>
              <li><a href="{{ route('about') }}#methodology">Teaching methodology</a></li>
              <li><a href="{{ route('about') }}#accreditations">Accreditations</a></li>
              <li><a href="{{ route('about') }}#facility">Our facility</a></li>
            </ul>
          </div>
        </li>

        <li class="nav__item"><a class="nav__link" href="{{ route('blog') }}" data-en="Blog" data-bn="ব্লগ">Blog</a></li>
        <li class="nav__item"><a class="nav__link" href="{{ route('contact') }}" data-en="Contact" data-bn="যোগাযোগ">Contact</a></li>
      </ul>

      <div class="nav__foot">
        <a href="{{ route('contact') }}" class="btn btn--primary btn--block" data-en="Free Consultation" data-bn="ফ্রি কনসালটেশন">Free Consultation</a>
        <a href="tel:{{ $settings['phone_raw'] ?? '' }}" class="nav__foot-call">
          <svg viewBox="0 0 24 24" class="ic" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.2a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg>
          {{ $settings['phone'] ?? '' }}
        </a>
      </div>
    </nav>

    <div class="header__cta">
      <a href="{{ route('contact') }}" class="btn btn--primary btn--sm" data-en="Free Consultation" data-bn="ফ্রি কনসালটেশন">Free Consultation</a>
      <button type="button" class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="nav">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>

  <div class="nav-backdrop" id="navBackdrop" hidden></div>
</header>
