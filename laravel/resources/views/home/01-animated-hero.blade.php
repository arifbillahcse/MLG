<!-- ═══════════════ 03 · ANIMATED HERO ═══════════════ -->
<section class="hero" id="hero">
  <canvas class="hero__petals" id="petals" aria-hidden="true"></canvas>
  <div class="hero__blob hero__blob--a" aria-hidden="true"></div>
  <div class="hero__blob hero__blob--b" aria-hidden="true"></div>
  <div class="hero__grid-lines" aria-hidden="true"></div>

  <div class="wrap hero__inner">
    <div class="hero__copy">
      <p class="eyebrow reveal" data-en="Dhaka · Language Training &amp; Study Abroad" data-bn="ঢাকা · ভাষা শিক্ষা ও বিদেশে পড়াশোনা">Dhaka · Language Training &amp; Study Abroad</p>

      <h1 class="hero__title reveal" data-delay="1">
        <span class="hero__line">Your gateway to</span>
        <span class="hero__line hero__rotator">
          <span class="rotator" id="rotator" aria-live="polite">
            <span class="rotator__item is-active" data-track="jp">Japan</span>
            <span class="rotator__item" data-track="gl">Korea</span>
            <span class="rotator__item" data-track="jp">China</span>
          </span>
        </span>
        <span class="hero__line hero__line--sub">language · admission · visa</span>
      </h1>

      <p class="hero__lede reveal" data-delay="2" data-en="Japanese, Korean, Chinese and IELTS — taught online or in class — plus university admission, scholarships and visa guidance for Japan, Korea and China. One team, from your first class to the departure gate." data-bn="জাপানিজ, কোরিয়ান, চাইনিজ ও IELTS — অনলাইন অথবা ক্লাসরুমে। সাথে জাপান, কোরিয়া ও চীনে ভর্তি, স্কলারশিপ এবং ভিসা গাইডেন্স। প্রথম ক্লাস থেকে বিমানবন্দর পর্যন্ত একটাই টিম।">Japanese, Korean, Chinese and IELTS — taught online or in class — plus university admission, scholarships and visa guidance for Japan, Korea and China. One team, from your first class to the departure gate.</p>

      <div class="hero__actions reveal" data-delay="3">
        <a href="#contact" class="btn btn--primary btn--lg btn--pulse" data-en="Book a Free Consultation" data-bn="ফ্রি কনসালটেশন বুক করুন">Book a Free Consultation</a>
        <a href="#courses" class="btn btn--ghost btn--lg" data-en="Enrol Now" data-bn="এখনই ভর্তি হন">Enrol Now</a>
      </div>

      <ul class="trust reveal" data-delay="4">
        <li class="trust__item">
          <span class="trust__num"><span class="count" data-target="{{ $settings['google_rating'] ?? '0' }}" data-decimals="1">0</span><span class="trust__unit">★</span></span>
          <span class="trust__label">Google rating</span>
        </li>
        <li class="trust__item">
          <span class="trust__num"><span class="count" data-target="{{ $settings['students_taught'] ?? '0' }}">0</span><span class="trust__unit">+</span></span>
          <span class="trust__label">Students taught</span>
        </li>
        <li class="trust__item">
          <span class="trust__num"><span class="count" data-target="{{ $courses->count() }}">0</span></span>
          <span class="trust__label">Languages offered</span>
        </li>
      </ul>
    </div>

    <div class="hero__art" aria-hidden="true">
      <div class="orbit">
        <div class="orbit__ring orbit__ring--outer"></div>
        <div class="orbit__ring orbit__ring--inner"></div>

        <div class="orbit__spin orbit__spin--outer">
          <span class="node node--jp" style="--a:0deg"><span class="node__in">🇯🇵</span></span>
          <span class="node node--jp" style="--a:60deg"><span class="node__in">🇰🇷</span></span>
          <span class="node node--jp" style="--a:120deg"><span class="node__in">🇨🇳</span></span>
          <span class="node" style="--a:180deg"><span class="node__in">🇦🇺</span></span>
          <span class="node" style="--a:240deg"><span class="node__in">🇬🇧</span></span>
          <span class="node" style="--a:300deg"><span class="node__in">🇨🇦</span></span>
        </div>

        <div class="orbit__spin orbit__spin--inner">
          <span class="node node--kana" style="--a:30deg"><span class="node__in">あ</span></span>
          <span class="node node--kana" style="--a:150deg"><span class="node__in">한</span></span>
          <span class="node node--kana" style="--a:270deg"><span class="node__in">中</span></span>
        </div>

        <div class="orbit__core">
          <span class="orbit__core-kicker">MLG</span>
          <span class="orbit__core-jp">言語</span>
          <span class="orbit__core-label">JLPT · TOPIK · HSK</span>
        </div>
      </div>

      <div class="float-card float-card--a">
        <span class="float-card__icon float-card__icon--red">
          <svg viewBox="0 0 24 24" class="ic"><path d="M12 3 2 8l10 5 10-5z"/><path d="M6 11v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5"/></svg>
        </span>
        <span>
          <b>4 languages</b>
          <small>Japanese, Korean, Chinese, IELTS</small>
        </span>
      </div>

      <div class="float-card float-card--b">
        <span class="float-card__icon float-card__icon--teal">
          <svg viewBox="0 0 24 24" class="ic"><rect x="2" y="4" width="20" height="13" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
        </span>
        <span>
          <b>Online or in class</b>
          <small>Recorded lessons included</small>
        </span>
      </div>

      <div class="float-card float-card--c">
        <span class="float-card__icon float-card__icon--gold">
          <svg viewBox="0 0 24 24" class="ic"><path d="M21 14a2 2 0 0 1-2 2H8l-4 4V5a2 2 0 0 1 2-2h13a2 2 0 0 1 2 2z"/><path d="M8.5 9.5h7M8.5 12.5h4"/></svg>
        </span>
        <span>
          <b>Free consultation</b>
          <small>30-minute roadmap</small>
        </span>
      </div>
    </div>
  </div>

  <div class="hero__scroll" aria-hidden="true"><span></span>Scroll</div>
</section>
