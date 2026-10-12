<!-- ═══════════════ 09 · WHY CHOOSE US ═══════════════ -->
<section class="section" id="why">
  <div class="wrap">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow">Why choose us</p>
      <h2 data-en="How we teach, and why it works" data-bn="আমরা কীভাবে পড়াই, এবং কেন কাজ করে">How we teach, and why it works</h2>
    </header>

    <div class="pillars">
      <article class="pillar reveal" data-delay="1">
        <span class="pillar__no mono">01</span>
        <h3>Native-level instruction</h3>
        <p>Teachers who have lived, studied or worked in the country they teach. Conversation practice from week one, not month three.</p>
      </article>
      <article class="pillar reveal" data-delay="2">
        <span class="pillar__no mono">02</span>
        <h3>Exam-shaped syllabus</h3>
        <p>Every module maps to a JLPT, TOPIK, HSK or IELTS task type. You practise the real format, not generic exercises.</p>
      </article>
      <article class="pillar reveal" data-delay="3">
        <span class="pillar__no mono">03</span>
        <h3>Progress tracking</h3>
        <p>Weekly mocks with a written score breakdown, so you know your level before the exam board tells you.</p>
      </article>
      <article class="pillar reveal" data-delay="4">
        <span class="pillar__no mono">04</span>
        <h3>One team, whole journey</h3>
        <p>Class, exam, university application, scholarship and visa handled under one roof. You never get passed to a third agency.</p>
      </article>
    </div>

    <div class="badges reveal" data-delay="4" id="badges" style="margin-top:var(--s8)">
      @foreach ($accreditations as $accreditation)
      <span class="badge">
        <span class="badge__ic"><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg></span>
        {{ $accreditation->title }}
      </span>
      @endforeach
    </div>
    <p class="partners__note">Replace these with the accreditations you can evidence, and link each to its certificate.</p>
  </div>
</section>
