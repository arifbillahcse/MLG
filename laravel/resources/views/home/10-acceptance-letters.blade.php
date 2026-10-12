<!-- ═══════════════ 12 · ACCEPTANCE LETTERS ═══════════════ -->
<section class="section section--band" id="letters">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Proof</p>
      <h2 data-en="Offer letters our students received" data-bn="আমাদের শিক্ষার্থীদের অফার লেটার">Offer letters our students received</h2>
      <p class="sec-head__lede">Names and student numbers redacted. Originals available to view at the office.</p>
    </header>

    <div class="letters">
      @foreach ($letters as $i => $letter)
      <article class="letter reveal" data-delay="{{ $i + 1 }}">
        @if ($letter->image)
          <img src="{{ asset('storage/'.$letter->image) }}" alt="Offer letter from {{ $letter->university }}" style="flex:1;object-fit:cover;border-radius:6px;margin-bottom:var(--s3)">
        @else
          <div class="letter__redact" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span></div>
        @endif
        <p class="letter__uni">{{ $letter->university }}</p>
        <p class="letter__meta">{{ $letter->destination?->flag }} {{ $letter->intake }}</p>
      </article>
      @endforeach
    </div>
  </div>
</section>
