<!-- ═══════════════ 18 · ABOUT / FACILITY ═══════════════ -->
<section class="section section--band" id="about">
  <div class="wrap">
    <div class="about">
      <div class="reveal">
        <p class="eyebrow">About MLG</p>
        <h2 data-en="Multi Languages Gateway" data-bn="মাল্টি ল্যাঙ্গুয়েজেস গেটওয়ে">Multi Languages Gateway</h2>
        <p class="sec-head__lede" style="margin-bottom:var(--s6)">A Dhaka language institute and study-abroad consultancy under one roof, teaching Japanese, Korean, Chinese and IELTS, and placing students in Japan, Korea and China.</p>

        <div class="mv">
          <div class="mv__item">
            <h3>{{ $mission?->t('title') ?? 'Our mission' }}</h3>
            <p>{{ $mission?->t('body') ?? '' }}</p>
          </div>
          <div class="mv__item">
            <h3>{{ $vision?->t('title') ?? 'Our vision' }}</h3>
            <p>{{ $vision?->t('body') ?? '' }}</p>
          </div>
        </div>
      </div>

      <div class="reveal" data-delay="1">
        <div class="facility">
          <div class="facility__photo facility__photo--1"><span>Reception</span></div>
          <div class="facility__photo facility__photo--2"><span>Classroom</span></div>
          <div class="facility__photo facility__photo--3"><span>Language lab</span></div>
          <div class="facility__photo facility__photo--4"><span>Counselling room</span></div>
        </div>
        <p class="partners__note" style="text-align:left;margin-top:var(--s4)">Replace with real photographs of the centre. <a href="{{ route('contact') }}" style="color:var(--teal);border-bottom:1px solid currentColor">See location and map →</a></p>
      </div>
    </div>
  </div>
</section>
