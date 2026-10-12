<!-- ═══════════════ 08 · BATCH SCHEDULE ═══════════════ -->
<section class="section section--band" id="batch">
  <div class="wrap">
    <div class="batch">
      <div class="batch__copy reveal">
        <p class="eyebrow">Admission open</p>
        <h2 data-en="Next batch starts in" data-bn="পরবর্তী ব্যাচ শুরু হবে">Next batch starts in</h2>
        <p class="sec-head__lede">Seats are released in blocks of twenty. When a batch fills or its date passes, the card updates itself.</p>

        <div class="countdown" id="countdown" role="timer" aria-label="Time until next batch starts"
             @if ($featuredBatch?->starts_at) data-starts="{{ $featuredBatch->starts_at->toIso8601String() }}" @endif>
          <div class="countdown__unit"><b class="mono" data-cd="d">00</b><span>Days</span></div>
          <div class="countdown__sep">:</div>
          <div class="countdown__unit"><b class="mono" data-cd="h">00</b><span>Hours</span></div>
          <div class="countdown__sep">:</div>
          <div class="countdown__unit"><b class="mono" data-cd="m">00</b><span>Minutes</span></div>
          <div class="countdown__sep">:</div>
          <div class="countdown__unit"><b class="mono" data-cd="s">00</b><span>Seconds</span></div>
        </div>
      </div>

      <div class="batch__cards">
        @foreach ($batches as $i => $batch)
        <article class="batch__card reveal" data-delay="{{ $i + 1 }}">
          <span class="batch__tag {{ $batch->mode === 'online' ? 'batch__tag--gl' : 'batch__tag--jp' }}">{{ $batch->tag }}</span>
          <h3>{{ $batch->title }}</h3>
          <dl class="batch__meta">
            <div><dt>Time</dt><dd class="mono">{{ $batch->time_label }}</dd></div>
            <div><dt>Days</dt><dd class="mono">{{ $batch->days }}</dd></div>
            <div><dt>Duration</dt><dd class="mono">{{ $batch->duration_label }}</dd></div>
          </dl>
          <div class="seats">
            <div class="seats__bar{{ $batch->mode === 'online' ? ' seats__bar--gl' : '' }}"><span style="--fill:{{ $batch->seats_filled_percent }}%"></span></div>
            <p class="seats__text">
              @if ($batch->starts_at)
                <b>{{ $batch->seats_left }}</b> of {{ $batch->seats_total }} seats left
              @else
                Enrol any time
              @endif
            </p>
          </div>
          <a href="{{ route('contact') }}" class="btn {{ $batch->mode === 'online' ? 'btn--secondary' : 'btn--primary' }} btn--block btn--sm">{{ $batch->starts_at ? 'Reserve a seat' : 'Enrol now' }}</a>
        </article>
        @endforeach
      </div>
    </div>
  </div>
</section>
