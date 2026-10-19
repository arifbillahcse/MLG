<!-- ═══════════════ 11 · SEMINAR ═══════════════ -->
<section class="section section--band" id="seminar">
  <div class="wrap">
    <div class="seminar">
      <div class="seminar__copy reveal">
        <p class="eyebrow">Free seminar</p>
        <h2>{{ $seminar->title ?? "Study, Work &amp; Settle Abroad" }}</h2>
        <p class="sec-head__lede">Ninety minutes, no sales pitch. Japan, Korea and China side by side — real cost breakdown, part-time work rules, visa rejection reasons and a live Q&amp;A with students who flew last year.</p>
        <dl class="seminar__meta">
          <div><dt>Date</dt><dd class="mono">{{ $seminar?->starts_at?->format('j F, l') ?? 'To be announced' }}</dd></div>
          <div><dt>Time</dt><dd class="mono">{{ $seminar?->starts_at?->format('g:i A') ?? '—' }}</dd></div>
          <div><dt>Venue</dt><dd>{{ $seminar->venue ?? '' }}</dd></div>
          <div><dt>Seats</dt><dd class="mono">{{ $seminar->seats ?? '—' }}{{ $seminar?->is_free ? ' (free)' : '' }}</dd></div>
        </dl>
      </div>

      <form class="seminar__form reveal" data-delay="1" id="seminarForm" method="POST" action="{{ route('enquiry.store') }}" data-lead novalidate>
        @include('partials.form.head', ['form' => 'seminar', 'eventId' => $seminar?->id])
        <h3>Reserve your seat</h3>
        <div class="field">
          <label for="s-name">Full name</label>
          <input type="text" id="s-name" name="name" @error('name') aria-invalid="true" @enderror required autocomplete="name" placeholder="Md Arif Billah" value="{{ old('name') }}">
        </div>
        <div class="field">
          <label for="s-phone">Mobile number</label>
          <input type="tel" id="s-phone" name="phone" @error('phone') aria-invalid="true" @enderror required autocomplete="tel" inputmode="tel" placeholder="01XXXXXXXXX" pattern="^01[3-9][0-9]{8}$" value="{{ old('phone') }}">
          <small class="field__hint">We send a reminder SMS 24 hours before.</small>
        </div>
        <div class="field">
          <label for="s-interest">I'm interested in</label>
          <select id="s-interest" name="interest">
            @foreach ($courses as $course)
              <option>{{ $course->name }}@if ($course->exam_name) ({{ $course->exam_name }})@endif</option>
            @endforeach
            <option>Study abroad &amp; visa</option>
          </select>
        </div>
        <button type="submit" class="btn btn--primary btn--block">Reserve free seat</button>
        @include('partials.form.status', ['form' => 'seminar'])
      </form>
    </div>
  </div>
</section>
