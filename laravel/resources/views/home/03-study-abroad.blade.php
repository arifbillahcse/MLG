<!-- ═══════════════ 05 · STUDY ABROAD ═══════════════ -->
<section class="section section--band" id="destinations">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Study abroad</p>
      <h2 data-en="Three destinations, one process" data-bn="তিনটি দেশ, একটাই প্রসেস">Three destinations, one process</h2>
      <p class="sec-head__lede">University shortlisting, application, scholarship search and visa guidance — handled in-house for all three countries.</p>
    </header>

    <div class="dest">
      @foreach ($destinations as $i => $destination)
      <article class="dest__card reveal" data-delay="{{ $i + 1 }}">
        <span class="dest__flag" aria-hidden="true">{{ $destination->flag }}</span>
        <h3>{{ $destination->name }}</h3>
        <ul class="dest__list">
          @foreach ($destination->highlights ?? [] as $highlight)
            <li><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg>{{ $highlight }}</li>
          @endforeach
        </ul>
        <a href="{{ route('contact') }}" class="btn btn--secondary btn--block btn--sm">Explore {{ Str::after($destination->name, 'Study in ') }}</a>
      </article>
      @endforeach
    </div>
  </div>
</section>
