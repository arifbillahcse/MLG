<!-- ═══════════════ 14 · UNIVERSITIES ═══════════════ -->
<section class="section section--tight" id="partners">
  <div class="wrap">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow">Placements</p>
      <h2 data-en="Where our students go" data-bn="আমাদের শিক্ষার্থীরা যেখানে যায়">Where our students go</h2>
    </header>
  </div>

  <div class="marquee" aria-label="Partner institutions">
    <div class="marquee__track">
      @foreach ($partners as $partner)
        <span class="marquee__item">{{ $partner->name }}</span>
      @endforeach
      {{-- duplicated so the marquee can loop seamlessly --}}
      @foreach ($partners as $partner)
        <span class="marquee__item" aria-hidden="true">{{ $partner->name }}</span>
      @endforeach
    </div>
  </div>

  <div class="wrap">
    <p class="partners__note">Replace with logo files you can substantiate. An inflated partner count is a liability, not a selling point.</p>
  </div>
</section>
