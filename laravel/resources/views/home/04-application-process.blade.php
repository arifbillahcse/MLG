<!-- ═══════════════ 06 · APPLICATION PROCESS ═══════════════ -->
<section class="section section--dark" id="process">
  <div class="wrap">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow eyebrow--light">The process</p>
      <h2 data-en="Six steps, whichever country" data-bn="যে দেশেই যান, ছয়টি ধাপ">Six steps, whichever country</h2>
      <p class="sec-head__lede">Real timelines, not marketing ones. Where a step depends on intake season we say so.</p>
    </header>

    <ol class="timeline" id="timeline">
      @foreach ($processSteps as $i => $step)
      <li class="timeline__step reveal" data-delay="{{ $i + 1 }}">
        <span class="timeline__dot{{ $loop->last ? ' timeline__dot--end' : '' }}"></span>
        <span class="timeline__month mono">{{ $step->step_label }}</span>
        <h3>{{ $step->title }}</h3>
        <p>{{ $step->body }}</p>
      </li>
      @endforeach
    </ol>
  </div>
</section>
