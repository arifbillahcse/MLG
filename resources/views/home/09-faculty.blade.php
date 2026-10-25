<!-- ═══════════════ 11 · FACULTY ═══════════════ -->
<section class="section" id="faculty">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Our team</p>
      <h2 data-en="Who will actually teach you" data-bn="আপনাকে কারা পড়াবেন">Who will actually teach you</h2>
      <p class="sec-head__lede">Not a stock photo and a job title. Every instructor's background, experience and teaching approach is on their profile.</p>
    </header>

    <div class="faculty">
      @foreach ($faculty as $i => $member)
      <article class="fac reveal" data-delay="{{ $i + 1 }}">
        @if ($member->photo_url)
          <img class="fac__avatar" src="{{ $member->photo_url }}" alt="{{ $member->name }}" width="84" height="84">
        @else
          <span class="fac__avatar fac__avatar--{{ $member->avatar_variant }}" aria-hidden="true">{{ $member->initials }}</span>
        @endif
        <h3>{{ $member->name }}</h3>
        <p class="fac__role">{{ $member->role }}</p>
        @if ($member->credential)<p class="fac__cred">{{ $member->credential }}</p>@endif
        @if ($member->quote)<p class="fac__quote">{{ $member->quote }}</p>@endif
      </article>
      @endforeach
    </div>
  </div>
</section>
