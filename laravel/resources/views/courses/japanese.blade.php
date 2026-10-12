@extends('layouts.app')

@section('title', 'Japanese Language Course in Dhaka — JLPT N5 &amp; N4 | Multi Languages Gateway')
@section('description', 'JLPT N5 and N4 Japanese course in Dhaka. 4–5 months per level, online recorded or in class, from ৳8,500. Native-level instructors, mock papers included, fees published.')

@section('og')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Japanese Language Course — JLPT N5 &amp; N4 | MLG Dhaka">
    <meta property="og:description" content="From hiragana to JLPT N4. Online recorded or in class, same syllabus and certificate. Fees and schedule published.">
@endsection

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "Japanese Language Course — JLPT N5 &amp; N4",
  "description": "JLPT N5 and N4 preparation in Dhaka. Hiragana and katakana to elementary grammar, taught live in class or as a recorded online course.",
  "provider": {
    "@type": "EducationalOrganization",
    "name": "Multi Languages Gateway",
    "sameAs": "https://example.com/"
  },
  "inLanguage": "en",
  "teaches": "Japanese language, JLPT N5 and N4 preparation",
  "hasCourseInstance": [
    {
      "@type": "CourseInstance",
      "name": "JLPT N5 — in class",
      "courseMode": "onsite",
      "location": { "@type": "Place", "name": "MLG Dhanmondi centre", "address": "Dhanmondi, Dhaka 1205, Bangladesh" },
      "courseWorkload": "P4M"
    },
    {
      "@type": "CourseInstance",
      "name": "JLPT N5 — online recorded",
      "courseMode": "online",
      "courseWorkload": "P4M"
    }
  ]
}
</script>
@endpush

@section('content')
<section class="page-head">
  <div class="wrap">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span aria-hidden="true">/</span>
      <a href="{{ route('home') }}#courses">Language Courses</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">Japanese</span>
    </nav>
    <p class="eyebrow reveal">日本語 · JLPT N5 &amp; N4</p>
    <h1 class="reveal" data-delay="1" data-en="Japanese language course" data-bn="জাপানিজ ভাষা কোর্স">Japanese language course</h1>
    <p class="page-head__lede reveal" data-delay="2">From your first hiragana character to JLPT N4 — the level Japanese language schools and most employers actually ask for. Taught live at our Dhanmondi centre or as a recorded online course, same syllabus either way.</p>

    <dl class="facts reveal" data-delay="3">
      <div class="fact"><dt>Levels</dt><dd>N5 → N4</dd></div>
      <div class="fact"><dt>Duration</dt><dd>4–5 months per level</dd></div>
      <div class="fact"><dt>Format</dt><dd>Online or in class</dd></div>
      <div class="fact"><dt>Exam</dt><dd>JLPT / NAT-TEST</dd></div>
      <div class="fact"><dt>Fee from</dt><dd class="mono">৳ 8,500</dd></div>
    </dl>

    <div class="hero__actions reveal" data-delay="4" style="margin-top:var(--s6);margin-bottom:0">
      <a href="#enrol" class="btn btn--primary btn--lg">Enrol in this course</a>
      <a href="#fees" class="btn btn--ghost btn--lg">See fees &amp; schedule</a>
    </div>
  </div>
</section>

<!-- ═══════ LEVELS ═══════ -->
<section class="section" id="levels">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Levels</p>
      <h2 data-en="Two levels, taken in order" data-bn="দুটি লেভেল, ক্রমানুসারে">Two levels, taken in order</h2>
      <p class="sec-head__lede">Everyone starts at N5 unless a placement test says otherwise. N5 gets you into a Japanese language school; N4 makes your visa file materially stronger and opens part-time work you can actually do.</p>
    </header>

    <div class="lvls">
      <article class="lvl reveal" data-delay="1">
        <span class="lvl__badge">N5</span>
        <h3>Beginner</h3>
        <p class="lvl__sub">No prior Japanese needed. Start from the alphabet.</p>

        <div class="lvl__stats">
          <div class="lvl__stat"><b>4</b><span>months</span></div>
          <div class="lvl__stat"><b>48</b><span>classes</span></div>
          <div class="lvl__stat"><b>~800</b><span>vocabulary</span></div>
          <div class="lvl__stat"><b>~100</b><span>kanji</span></div>
        </div>

        <p class="lvl__what">What you'll be able to do</p>
        <ul class="lvl__list">
          <li><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg>Read and write hiragana and katakana fluently</li>
          <li><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg>Hold basic conversations — introductions, directions, shopping</li>
          <li><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg>Understand slow, everyday speech on familiar topics</li>
          <li><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg>Meet the entry requirement for most Japanese language schools</li>
        </ul>

        <div class="lvl__fees">
          <div class="lvl__fee"><span>In class</span><b class="mono">৳ 12,000</b></div>
          <div class="lvl__fee"><span>Online</span><b class="mono">৳ 8,500</b></div>
        </div>
        <a href="#enrol" class="btn btn--primary btn--block">Enrol in N5</a>
      </article>

      <article class="lvl lvl--next reveal" data-delay="2">
        <span class="lvl__badge">N4</span>
        <h3>Elementary</h3>
        <p class="lvl__sub">Follows N5. The level most schools and employers look for.</p>

        <div class="lvl__stats">
          <div class="lvl__stat"><b>5</b><span>months</span></div>
          <div class="lvl__stat"><b>60</b><span>classes</span></div>
          <div class="lvl__stat"><b>~1,500</b><span>vocabulary</span></div>
          <div class="lvl__stat"><b>~300</b><span>kanji</span></div>
        </div>

        <p class="lvl__what">What you'll be able to do</p>
        <ul class="lvl__list">
          <li><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg>Handle everyday conversation at natural speed</li>
          <li><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg>Read short passages written in basic kanji</li>
          <li><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg>Manage a part-time job interview and workplace instructions</li>
          <li><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg>Present a noticeably stronger student visa file</li>
        </ul>

        <div class="lvl__fees">
          <div class="lvl__fee"><span>In class</span><b class="mono">৳ 15,000</b></div>
          <div class="lvl__fee"><span>Online</span><b class="mono">৳ 10,500</b></div>
        </div>
        <a href="#enrol" class="btn btn--primary btn--block">Enrol in N4</a>
      </article>
    </div>
  </div>
</section>

<!-- ═══════ SYLLABUS ═══════ -->
<section class="section section--band" id="syllabus">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Course details</p>
      <h2 data-en="What we cover, month by month" data-bn="মাসে মাসে যা যা পড়ানো হয়">What we cover, month by month</h2>
      <p class="sec-head__lede">The N5 track in order. N4 continues the same structure with compound grammar, keigo basics and 200 further kanji.</p>
    </header>

    <div class="steps">
      <article class="step reveal" data-delay="1">
        <span class="step__no">MONTH 1</span>
        <h3>Hiragana &amp; katakana</h3>
        <p>Both syllabaries written and read to automaticity, plus greetings, numbers and self-introduction. You will be writing sentences by week three.</p>
      </article>
      <article class="step reveal" data-delay="2">
        <span class="step__no">MONTH 2</span>
        <h3>Core sentence patterns</h3>
        <p>です / ます forms, particles は・が・を・に・で, demonstratives, and the counting system Japanese actually uses day to day.</p>
      </article>
      <article class="step reveal" data-delay="3">
        <span class="step__no">MONTH 3</span>
        <h3>Verbs &amp; first kanji</h3>
        <p>Verb groups, te-form, past and negative. First 60 kanji introduced by radical, not by rote list.</p>
      </article>
      <article class="step reveal" data-delay="4">
        <span class="step__no">MONTH 4</span>
        <h3>Exam drilling &amp; kaiwa</h3>
        <p>Full JLPT N5 papers under timed conditions, listening practice at exam speed, and weekly conversation sessions with the instructor.</p>
      </article>
    </div>

    <div class="callout-note reveal" data-delay="4" style="margin-top:var(--s7)">
      <p class="partners__note" style="text-align:left">Every student sits at least four full mock papers before the real exam. Scores are returned with a written breakdown by section, so you know which skill to push before exam day.</p>
    </div>
  </div>
</section>

<!-- ═══════ ONLINE vs IN CLASS ═══════ -->
<section class="section" id="format">
  <div class="wrap">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow">How you study</p>
      <h2 data-en="Online recorded or in class" data-bn="অনলাইন রেকর্ডেড নাকি ক্লাসরুম">Online recorded or in class</h2>
      <p class="sec-head__lede">Same syllabus, same instructor, same certificate. Pick the format that fits your week — you can switch between them mid-course if your situation changes.</p>
    </header>

    <div class="compare">
      <div class="compare__card reveal" data-delay="1">
        <div class="compare__head">
          <span class="compare__icon">
            <svg viewBox="0 0 24 24" class="ic"><rect x="2" y="4" width="20" height="13" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
          </span>
          <div>
            <h3>Online recorded</h3>
            <p>Study on your own schedule</p>
          </div>
        </div>
        <div class="compare__rows">
          <div class="compare__row"><span>Lessons</span><b>Recorded, replay anytime</b></div>
          <div class="compare__row"><span>Access</span><b>12 months</b></div>
          <div class="compare__row"><span>Doubt-solving</span><b>Weekly live group session</b></div>
          <div class="compare__row"><span>Kaiwa practice</span><b>Scheduled 1-to-1 calls</b></div>
          <div class="compare__row"><span>Mock papers</span><b class="yes">Included</b></div>
          <div class="compare__row"><span>N5 fee</span><b class="mono">৳ 8,500</b></div>
        </div>
      </div>

      <div class="compare__card compare__card--featured reveal" data-delay="2">
        <div class="compare__head">
          <span class="compare__icon">
            <svg viewBox="0 0 24 24" class="ic"><path d="M3 21V8l9-5 9 5v13"/><path d="M9 21v-6h6v6"/></svg>
          </span>
          <div>
            <h3>In class</h3>
            <p>At the Dhanmondi centre</p>
          </div>
        </div>
        <div class="compare__rows">
          <div class="compare__row"><span>Lessons</span><b>Live, recordings included</b></div>
          <div class="compare__row"><span>Class size</span><b>20 students maximum</b></div>
          <div class="compare__row"><span>Doubt-solving</span><b>Every class</b></div>
          <div class="compare__row"><span>Kaiwa practice</span><b>Daily with classmates</b></div>
          <div class="compare__row"><span>Mock papers</span><b class="yes">Included, on paper</b></div>
          <div class="compare__row"><span>N5 fee</span><b class="mono">৳ 12,000</b></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ SCHEDULE & FEES ═══════ -->
<section class="section section--band" id="fees">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Schedule &amp; fees</p>
      <h2 data-en="Batches and what they cost" data-bn="ব্যাচ এবং খরচ">Batches and what they cost</h2>
    </header>

    <div class="fee-table reveal" data-delay="1" style="margin-bottom:var(--s5)">
      <h3 class="fee-table__title">Class schedule</h3>
      <div class="tbl-scroll">
        <table class="tbl">
          <caption class="sr-only">Japanese course batch schedule</caption>
          <thead>
            <tr><th scope="col">Batch</th><th scope="col">Level</th><th scope="col">Days</th><th scope="col">Time</th><th scope="col">Format</th></tr>
          </thead>
          <tbody>
            <tr><th scope="row">Morning</th><td>N5</td><td>Sat · Mon · Wed</td><td class="mono">10:00 AM – 11:30 AM</td><td>In class</td></tr>
            <tr><th scope="row">Afternoon</th><td>N5</td><td>Sun · Tue · Thu</td><td class="mono">3:00 PM – 4:30 PM</td><td>In class</td></tr>
            <tr><th scope="row">Evening</th><td>N4</td><td>Sat · Mon · Wed</td><td class="mono">6:30 PM – 8:00 PM</td><td>In class</td></tr>
            <tr><th scope="row">Self-paced</th><td>N5 · N4</td><td>Any</td><td class="mono">Enrol any time</td><td>Online</td></tr>
            <tr><th scope="row">Live doubt session</th><td>N5 · N4</td><td>Friday</td><td class="mono">8:00 PM – 9:00 PM</td><td>Online</td></tr>
          </tbody>
        </table>
      </div>
      <p class="fee-table__note">Missed an in-class session? Every class is recorded and released to your online account within 24 hours, at no extra cost.</p>
    </div>

    <div class="fee-table reveal" data-delay="2">
      <h3 class="fee-table__title">Fees</h3>
      <div class="tbl-scroll">
        <table class="tbl">
          <caption class="sr-only">Japanese course fees</caption>
          <thead>
            <tr><th scope="col">Level</th><th scope="col">Duration</th><th scope="col">Classes</th><th scope="col" class="ta-r">In class</th><th scope="col" class="ta-r">Online</th></tr>
          </thead>
          <tbody>
            <tr><th scope="row">JLPT N5</th><td>4 months</td><td class="mono">48</td><td class="ta-r mono">৳ 12,000</td><td class="ta-r mono">৳ 8,500</td></tr>
            <tr><th scope="row">JLPT N4</th><td>5 months</td><td class="mono">60</td><td class="ta-r mono">৳ 15,000</td><td class="ta-r mono">৳ 10,500</td></tr>
            <tr><th scope="row">N5 + N4 together</th><td>9 months</td><td class="mono">108</td><td class="ta-r mono">৳ 24,000</td><td class="ta-r mono">৳ 17,000</td></tr>
          </tbody>
        </table>
      </div>
      <p class="fee-table__note">Fees include course materials, all in-house mock papers and the recordings. <b>Not included:</b> the JLPT or NAT-TEST registration fee, which is paid directly to the exam body. Fees may be paid in two instalments — ask at enrolment.</p>
    </div>
  </div>
</section>

<!-- ═══════ INSTRUCTOR ═══════ -->
<section class="section" id="instructor">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Your instructor</p>
      <h2 data-en="Who teaches this course" data-bn="এই কোর্সটি কে পড়াবেন">Who teaches this course</h2>
    </header>

    <div class="faculty">
      <article class="fac reveal" data-delay="1">
        <span class="fac__avatar fac__avatar--r" aria-hidden="true">SR</span>
        <h3>Shahriar Rahman</h3>
        <p class="fac__role">Lead instructor · JLPT</p>
        <p class="fac__cred">JLPT N1 · 6 years in Tokyo</p>
        <p class="fac__quote">"Speak from day one. Perfect grammar with no confidence gets you nowhere at the embassy."</p>
      </article>
      <article class="fac reveal" data-delay="2">
        <span class="fac__avatar" aria-hidden="true">MK</span>
        <h3>Mahfuza Khatun</h3>
        <p class="fac__role">Instructor · N5 batches</p>
        <p class="fac__cred">JLPT N2 · 4 years teaching</p>
        <p class="fac__quote">"Beginners quit over kanji. Teach the radicals first and it stops being memorisation."</p>
      </article>
      <article class="fac reveal" data-delay="3">
        <span class="fac__avatar fac__avatar--t" aria-hidden="true">YT</span>
        <h3>Yuki Tanaka</h3>
        <p class="fac__role">Kaiwa sessions</p>
        <p class="fac__cred">Native speaker · Weekly conversation</p>
        <p class="fac__quote">"Students understand more than they can say. Conversation class is for closing that gap."</p>
      </article>
    </div>
  </div>
</section>

<!-- ═══════ RESULTS ═══════ -->
<section class="section section--band" id="results">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Results</p>
      <h2 data-en="Recent JLPT passes" data-bn="সাম্প্রতিক JLPT পাস">Recent JLPT passes</h2>
      <p class="sec-head__lede">Published with each student's permission.</p>
    </header>

    <div class="results">
      <div class="result reveal" data-delay="1">
        <span class="result__exam">JLPT</span>
        <p class="result__score">N4</p>
        <p class="result__name">Rahat Hossain</p>
        <p class="result__meta">Passed in 7 months</p>
      </div>
      <div class="result reveal" data-delay="1">
        <span class="result__exam">JLPT</span>
        <p class="result__score">N5</p>
        <p class="result__name">Ayesha Siddiqua</p>
        <p class="result__meta">First attempt · 2025</p>
      </div>
      <div class="result reveal" data-delay="2">
        <span class="result__exam">NAT</span>
        <p class="result__score">N5</p>
        <p class="result__name">Imran Kabir</p>
        <p class="result__meta">Online course · 2025</p>
      </div>
      <div class="result reveal" data-delay="2">
        <span class="result__exam">JLPT</span>
        <p class="result__score">N4</p>
        <p class="result__name">Sumaiya Haque</p>
        <p class="result__meta">First attempt · 2025</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ WHERE IT LEADS ═══════ -->
<section class="section section--dark" id="next">
  <div class="wrap">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow eyebrow--light">After the course</p>
      <h2 data-en="Where N4 takes you" data-bn="N4 আপনাকে কোথায় নিয়ে যায়">Where N4 takes you</h2>
      <p class="sec-head__lede">The course is a means, not the goal. Here is what it unlocks.</p>
    </header>

    <ol class="timeline">
      <li class="timeline__step reveal" data-delay="1">
        <span class="timeline__dot"></span>
        <span class="timeline__month mono">N5</span>
        <h3>Language school entry</h3>
        <p>Meets the minimum most Japanese language schools require to issue an offer.</p>
      </li>
      <li class="timeline__step reveal" data-delay="2">
        <span class="timeline__dot"></span>
        <span class="timeline__month mono">N4</span>
        <h3>Stronger visa file</h3>
        <p>Immigration reads proficiency as evidence of genuine intent. N4 files are read differently to N5 ones.</p>
      </li>
      <li class="timeline__step reveal" data-delay="3">
        <span class="timeline__dot"></span>
        <span class="timeline__month mono">N4+</span>
        <h3>Part-time work</h3>
        <p>Enough Japanese to hold the interview and follow instructions in a real workplace.</p>
      </li>
      <li class="timeline__step reveal" data-delay="4">
        <span class="timeline__dot timeline__dot--end"></span>
        <span class="timeline__month mono">N2</span>
        <h3>Japanese-taught degrees</h3>
        <p>Universities teaching in Japanese want N2. N4 is the halfway mark, not the destination.</p>
      </li>
    </ol>

    <div style="text-align:center;margin-top:var(--s7)">
      <a href="{{ route('home') }}#destinations" class="btn btn--gold btn--lg reveal" data-delay="4">See the Japan study-abroad route</a>
    </div>
  </div>
</section>

<!-- ═══════ ENROLMENT ═══════ -->
<section class="section" id="enrol">
  <div class="wrap">
    <div class="seminar">
      <div class="seminar__copy reveal">
        <p class="eyebrow">Enrol</p>
        <h2 data-en="Register for the Japanese course" data-bn="জাপানিজ কোর্সে রেজিস্ট্রেশন করুন">Register for the Japanese course</h2>
        <p class="sec-head__lede">Fill this in and a counsellor calls you within one working day to confirm your level, batch and payment schedule. If you are unsure whether to start at N5 or N4, book the free placement test instead — it takes 30 minutes.</p>
        <dl class="seminar__meta">
          <div><dt>Next N5 batch</dt><dd>Morning &amp; afternoon</dd></div>
          <div><dt>Next N4 batch</dt><dd>Evening</dd></div>
          <div><dt>Online</dt><dd>Enrol any time</dd></div>
          <div><dt>Placement test</dt><dd>Free, 30 minutes</dd></div>
        </dl>
      </div>

      <form class="seminar__form reveal" data-delay="1" id="japaneseEnrol" data-lead novalidate>
        <h3>Course registration</h3>
        <div class="field">
          <label for="j-name">Full name</label>
          <input type="text" id="j-name" name="name" required autocomplete="name" placeholder="Your name">
        </div>
        <div class="field">
          <label for="j-phone">Mobile number</label>
          <input type="tel" id="j-phone" name="phone" required autocomplete="tel" inputmode="tel" placeholder="01XXXXXXXXX">
        </div>
        <div class="field">
          <label for="j-level">Level</label>
          <select id="j-level" name="level">
            <option>JLPT N5 — beginner</option>
            <option>JLPT N4 — elementary</option>
            <option>N5 + N4 together</option>
            <option>Not sure — book a placement test</option>
          </select>
        </div>
        <div class="field">
          <label for="j-format">Format</label>
          <select id="j-format" name="format">
            <option>In class — Dhanmondi centre</option>
            <option>Online recorded</option>
          </select>
        </div>
        <button type="submit" class="btn btn--primary btn--block">Register for this course</button>
        <p class="form__status" role="status" aria-live="polite"></p>
      </form>
    </div>
  </div>
</section>

<!-- ═══════ FAQ ═══════ -->
<section class="section section--band" id="faq">
  <div class="wrap wrap--narrow">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow">FAQ</p>
      <h2 data-en="About the Japanese course" data-bn="জাপানিজ কোর্স সম্পর্কে">About the Japanese course</h2>
    </header>

    <div class="faq">
      <div class="faq__item reveal">
        <button type="button" class="faq__q" aria-expanded="false">
          <span>I know nothing at all. Can I still join?</span>
          <span class="faq__icon" aria-hidden="true"></span>
        </button>
        <div class="faq__a"><p>Yes — N5 assumes zero Japanese. Month one is the two alphabets, taught from scratch. Roughly four in five of our N5 students have never seen a Japanese character before their first class.</p></div>
      </div>
      <div class="faq__item reveal">
        <button type="button" class="faq__q" aria-expanded="false">
          <span>How long until I can apply to a language school?</span>
          <span class="faq__icon" aria-hidden="true"></span>
        </button>
        <div class="faq__a"><p>Four months of N5, then the exam. JLPT is held twice a year (July and December), so the exam date usually decides your timeline rather than the course length. NAT-TEST runs more often and is accepted by most schools — we plan around whichever fits your intake.</p></div>
      </div>
      <div class="faq__item reveal">
        <button type="button" class="faq__q" aria-expanded="false">
          <span>Is the online course really the same?</span>
          <span class="faq__icon" aria-hidden="true"></span>
        </button>
        <div class="faq__a"><p>Same syllabus, same instructor, same mock papers, same certificate. What differs is live interaction: the online course gives you a weekly group doubt session and scheduled one-to-one kaiwa calls, where in class you get that every session. Online access lasts twelve months.</p></div>
      </div>
      <div class="faq__item reveal">
        <button type="button" class="faq__q" aria-expanded="false">
          <span>What if I miss classes?</span>
          <span class="faq__icon" aria-hidden="true"></span>
        </button>
        <div class="faq__a"><p>Every in-class session is recorded and appears in your online account within 24 hours, included in the fee. If you miss more than four consecutive classes we will move you to the next batch rather than let you fall behind.</p></div>
      </div>
      <div class="faq__item reveal">
        <button type="button" class="faq__q" aria-expanded="false">
          <span>Do you register me for the JLPT exam?</span>
          <span class="faq__icon" aria-hidden="true"></span>
        </button>
        <div class="faq__a"><p>We handle the paperwork and remind you of the deadline, but the registration fee is paid directly to the exam body and is not part of the course fee. Registration closes months before the exam, and missing it costs you half a year.</p></div>
      </div>
      <div class="faq__item reveal">
        <button type="button" class="faq__q" aria-expanded="false">
          <span>Can I pay in instalments?</span>
          <span class="faq__icon" aria-hidden="true"></span>
        </button>
        <div class="faq__a"><p>Yes, in two instalments — half at enrolment, half at the midpoint of the course. Ask the counsellor at registration; there is no extra charge for it.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ FINAL CTA ═══════ -->
<section class="cta" id="contact">
  <canvas class="cta__stars" id="ctaStars" aria-hidden="true"></canvas>
  <div class="wrap cta__inner">
    <div class="cta__copy reveal">
      <p class="eyebrow eyebrow--gold">Not sure yet?</p>
      <h2 data-en="Sit a free placement test first" data-bn="আগে ফ্রি প্লেসমেন্ট টেস্ট দিন">Sit a free placement test first</h2>
      <p>Thirty minutes, no cost, no obligation. You get a written assessment of where you actually are and an honest recommendation on which level to start at — including "you don't need our course yet" if that's the truth.</p>
      <ul class="cta__points">
        <li>Written level assessment on the day</li>
        <li>Full cost and timeline to your target intake</li>
        <li>Bangla or English, whichever you prefer</li>
      </ul>
    </div>

    <form class="cta__form reveal" data-delay="1" id="japanesePlacement" data-lead novalidate>
      <div class="field">
        <label for="p-name">Full name</label>
        <input type="text" id="p-name" name="name" required autocomplete="name" placeholder="Your name">
      </div>
      <div class="field">
        <label for="p-phone">Mobile number</label>
        <input type="tel" id="p-phone" name="phone" required autocomplete="tel" inputmode="tel" placeholder="01XXXXXXXXX">
      </div>
      <div class="field">
        <label for="p-exp">Any Japanese already?</label>
        <select id="p-exp" name="experience">
          <option>None at all</option>
          <option>I know hiragana / katakana</option>
          <option>I have studied N5 before</option>
          <option>I have passed N5</option>
        </select>
      </div>
      <button type="submit" class="btn btn--gold btn--block btn--lg">Book free placement test</button>
      <p class="form__status" role="status" aria-live="polite"></p>
      <p class="cta__privacy">We call once. No spam, no selling your number.</p>
    </form>
  </div>
</section>
@endsection
