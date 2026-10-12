@extends('layouts.app')

@section('title', 'About Us — Multi Languages Gateway, Dhaka')
@section('description', 'Multi Languages Gateway is a Dhaka language institute and study-abroad consultancy — Japanese, Korean, Chinese and IELTS, with admission, scholarship and visa support for Japan, Korea and China. Our mission, team, methodology and accreditations.')

@section('og')
    <meta property="og:type" content="website">
    <meta property="og:title" content="About Multi Languages Gateway">
    <meta property="og:description" content="A language institute and a study-abroad consultancy under one roof, in Dhanmondi, Dhaka.">
@endsection

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AboutPage",
  "name": "About Multi Languages Gateway",
  "mainEntity": {
    "@type": "EducationalOrganization",
    "name": "Multi Languages Gateway",
    "alternateName": "MLG",
    "description": "Language institute and study-abroad consultancy in Dhaka, Bangladesh — Japanese, Korean, Chinese and IELTS, with admission, scholarship and visa support for Japan, Korea and China.",
    "founder": { "@type": "Person", "name": "A. K. M. Rahman", "jobTitle": "Chairman & Founder" },
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "House 00, Road 00, Dhanmondi",
      "addressLocality": "Dhaka",
      "postalCode": "1205",
      "addressCountry": "BD"
    }
  }
}
</script>
@endpush

@section('content')
<section class="page-head">
  <div class="wrap">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">About Us</span>
    </nav>
    <p class="eyebrow reveal">About MLG</p>
    <h1 class="reveal" data-delay="1" data-en="A language institute and a consultancy, under one roof" data-bn="এক ছাদের নিচে ভাষা শিক্ষা ও কনসালটেন্সি">A language institute and a consultancy, under one roof</h1>
    <p class="page-head__lede reveal" data-delay="2">Most Bangladeshi students deal with one company for the language and another for the visa, and lose months in the gap between them. Multi Languages Gateway exists to close that gap — Japanese, Korean, Chinese and IELTS taught in-house, and admission, scholarship and visa work handled by the same team.</p>

    <div class="stat-row reveal" data-delay="3" style="margin-top:var(--s6)">
      <div class="stat"><p class="stat__num"><span class="count" data-target="1200">0</span><span class="trust__unit">+</span></p><p class="stat__label">Students taught</p></div>
      <div class="stat"><p class="stat__num"><span class="count" data-target="4">0</span></p><p class="stat__label">Languages offered</p></div>
      <div class="stat"><p class="stat__num"><span class="count" data-target="3">0</span></p><p class="stat__label">Destination countries</p></div>
      <div class="stat"><p class="stat__num"><span class="count" data-target="96">0</span><span class="trust__unit">%</span></p><p class="stat__label">Visa success rate</p></div>
      <div class="stat"><p class="stat__num"><span class="count" data-target="4.9" data-decimals="1">0</span><span class="trust__unit">&#9733;</span></p><p class="stat__label">Google rating</p></div>
    </div>
  </div>
</section>

<!-- ═══════ CHAIRMAN'S MESSAGE ═══════ -->
<section class="section" id="chairman">
  <div class="wrap">
    <article class="chairman reveal">

      <div class="chairman__photo">
        <span class="chairman__swap">Replace with photo</span>
        <!-- Drop the real portrait in here and delete the silhouette below:
             <img src="{{ asset('assets/img/chairman.jpg') }}" width="800" height="1000"
                  alt="Chairman and Founder of Multi Languages Gateway"> -->
        <svg class="chairman__silhouette" viewBox="0 0 200 250" aria-hidden="true">
          <circle cx="100" cy="74" r="44" fill="rgba(255,255,255,.22)"/>
          <path d="M100 126c-44 0-76 28-82 66-2 12 0 58 0 58h164s2-46 0-58c-6-38-38-66-82-66z"
                fill="rgba(255,255,255,.16)"/>
          <path d="M100 126c-10 0-19 1-27 4l27 34 27-34c-8-3-17-4-27-4z" fill="rgba(255,255,255,.26)"/>
        </svg>
      </div>

      <div class="chairman__body">
        <span class="chairman__quote" aria-hidden="true">&#8220;</span>
        <p class="eyebrow" data-en="Message from the Chairman" data-bn="চেয়ারম্যানের বার্তা">Message from the Chairman</p>
        <h2 data-en="Guiding your path, whichever country you choose" data-bn="আপনি যে দেশই বেছে নিন, পথ দেখাব আমরা">Guiding your path, whichever country you choose</h2>

        <p class="chairman__text">Welcome to Multi Languages Gateway. We founded MLG on a
        simple conviction: a Bangladeshi student with the ability to study abroad should not
        be held back by poor guidance, hidden costs or a language barrier nobody helped them
        cross.</p>

        <p class="chairman__text">So we teach the language properly — Japanese, Korean,
        Chinese and IELTS — and we stay with you through admission, scholarship and visa.
        One team, start to finish. We publish our fees, we tell you honestly when a plan is
        not realistic, and we do not take a file we do not believe in.</p>

        <div class="chairman__sign">
          <div>
            <!-- PLACEHOLDER: replace with the real chairman's name before launch -->
            <p class="chairman__name">A. K. M. Rahman</p>
            <p class="chairman__role">Chairman &amp; Founder</p>
          </div>
          <span class="chairman__jp" lang="ja">皆様のご成功をお祈りしています</span>
        </div>
      </div>

    </article>
  </div>
</section>

<!-- ═══════ MISSION & VISION ═══════ -->
<section class="section section--band" id="mission">
  <div class="wrap">
    <div class="about">
      <div class="reveal">
        <p class="eyebrow">What drives us</p>
        <h2 data-en="Mission &amp; vision" data-bn="মিশন ও ভিশন">Mission &amp; vision</h2>
        <p class="sec-head__lede" style="margin-bottom:var(--s6)">Two statements we are willing to be measured against.</p>

        <div class="mv">
          <div class="mv__item">
            <h3>Our mission</h3>
            <p>To make studying abroad reachable for Bangladeshi students who have the ability but not the guidance — by teaching the language properly and telling the truth about cost, timeline and odds.</p>
          </div>
          <div class="mv__item">
            <h3>Our vision</h3>
            <p>To be the institute Bangladeshi families name first when a student says they want to study in Japan, Korea or China.</p>
          </div>
        </div>
      </div>

      <div class="reveal" data-delay="1">
        <div class="certs" style="grid-template-columns:1fr">
          <article class="cert">
            <span class="cert__seal"><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg></span>
            <div><h3>We publish our prices</h3><p>Every course fee is on the website. No "call for price", and no charge that appears after you have paid the first instalment.</p></div>
          </article>
          <article class="cert">
            <span class="cert__seal"><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg></span>
            <div><h3>We decline files we don't believe in</h3><p>If an application is unlikely to pass, we say so rather than take the fee. It is why our visa success rate is what it is.</p></div>
          </article>
          <article class="cert">
            <span class="cert__seal"><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg></span>
            <div><h3>One team, whole journey</h3><p>Class, exam, university, scholarship and visa under one roof. You are never passed to a third agency that blames the first.</p></div>
          </article>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ METHODOLOGY ═══════ -->
<section class="section" id="methodology">
  <div class="wrap">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow">How we teach</p>
      <h2 data-en="Our teaching methodology" data-bn="আমাদের শিক্ষাপদ্ধতি">Our teaching methodology</h2>
      <p class="sec-head__lede">The same four principles apply whether you are learning hiragana, hangul, pinyin or IELTS writing.</p>
    </header>

    <div class="steps">
      <article class="step reveal" data-delay="1">
        <span class="step__no">01</span>
        <h3>Speak from week one</h3>
        <p>Conversation starts in the first month, not after the grammar is "finished". Students who wait to feel ready never start speaking at all.</p>
      </article>
      <article class="step reveal" data-delay="2">
        <span class="step__no">02</span>
        <h3>Teach to the exam format</h3>
        <p>Every module maps to a real JLPT, TOPIK, HSK or IELTS task type. You practise the paper you will actually sit, not generic exercises.</p>
      </article>
      <article class="step reveal" data-delay="3">
        <span class="step__no">03</span>
        <h3>Measure every week</h3>
        <p>Weekly mocks with a written breakdown by section. You know your level before the exam board tells you, while there is still time to fix it.</p>
      </article>
      <article class="step reveal" data-delay="4">
        <span class="step__no">04</span>
        <h3>Small batches, real attention</h3>
        <p>Twenty students maximum in a classroom batch. Beyond that, the quiet students stop being noticed — and they are usually the ones who need help.</p>
      </article>
    </div>
  </div>
</section>

<!-- ═══════ TEAM ═══════ -->
<section class="section section--band" id="team">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Our team</p>
      <h2 data-en="The people you will actually deal with" data-bn="যাদের সাথে আপনি সরাসরি কাজ করবেন">The people you will actually deal with</h2>
      <p class="sec-head__lede">Instructors teach the classes. Counsellors handle your application, scholarship and visa. Both sit in the same office, which is the point.</p>
    </header>

    <div class="team-group reveal">
      <div class="team-group__head">
        <h3>Instructors</h3>
        <p>Language and exam preparation</p>
      </div>
      <div class="faculty">
        <article class="fac reveal" data-delay="1">
          <span class="fac__avatar fac__avatar--r" aria-hidden="true">SR</span>
          <h3>Shahriar Rahman</h3>
          <p class="fac__role">Japanese · JLPT</p>
          <p class="fac__cred">JLPT N1 · 6 years in Tokyo</p>
          <p class="fac__quote">"Speak from day one. Perfect grammar with no confidence gets you nowhere at the embassy."</p>
        </article>
        <article class="fac reveal" data-delay="2">
          <span class="fac__avatar" aria-hidden="true">JH</span>
          <h3>Jinhee Park</h3>
          <p class="fac__role">Korean · TOPIK</p>
          <p class="fac__cred">Native speaker · 8 years teaching</p>
          <p class="fac__quote">"TOPIK rewards pattern recognition. We drill the patterns until they're automatic."</p>
        </article>
        <article class="fac reveal" data-delay="3">
          <span class="fac__avatar" aria-hidden="true">LW</span>
          <h3>Li Wei</h3>
          <p class="fac__role">Chinese · HSK</p>
          <p class="fac__cred">HSK examiner training · 5 years</p>
          <p class="fac__quote">"Tones first. Every hour on tones early saves ten hours of correction later."</p>
        </article>
        <article class="fac reveal" data-delay="4">
          <span class="fac__avatar fac__avatar--t" aria-hidden="true">FA</span>
          <h3>Farhana Akter</h3>
          <p class="fac__role">IELTS</p>
          <p class="fac__cred">Band 8.5 · 7 years coaching</p>
          <p class="fac__quote">"Most students plateau at 6.5 on fluency, not grammar. That's what we train."</p>
        </article>
      </div>
    </div>

    <div class="team-group reveal">
      <div class="team-group__head">
        <h3>Counsellors</h3>
        <p>Admission, scholarship and visa</p>
      </div>
      <div class="faculty">
        <article class="fac reveal" data-delay="1">
          <span class="fac__avatar" aria-hidden="true">AH</span>
          <h3>Ashraful Haque</h3>
          <p class="fac__role">Japan desk</p>
          <p class="fac__cred">COE &amp; student visa · 5 years</p>
          <p class="fac__quote">"Most rejections are paperwork, not the student. That is fixable before filing."</p>
        </article>
        <article class="fac reveal" data-delay="2">
          <span class="fac__avatar fac__avatar--t" aria-hidden="true">RN</span>
          <h3>Rubaiya Nasrin</h3>
          <p class="fac__role">Korea &amp; China desk</p>
          <p class="fac__cred">GKS and CSC applications</p>
          <p class="fac__quote">"Scholarship deadlines close months before admission does. We plan backwards from them."</p>
        </article>
        <article class="fac reveal" data-delay="3">
          <span class="fac__avatar fac__avatar--r" aria-hidden="true">TI</span>
          <h3>Tanjim Islam</h3>
          <p class="fac__role">Student counselling</p>
          <p class="fac__cred">First consultation &amp; planning</p>
          <p class="fac__quote">"My job in the first meeting is to be honest, even when the honest answer is no."</p>
        </article>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ ACCREDITATIONS ═══════ -->
<section class="section" id="accreditations">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Credentials</p>
      <h2 data-en="Accreditations &amp; certifications" data-bn="স্বীকৃতি ও সনদ">Accreditations &amp; certifications</h2>
      <p class="sec-head__lede">Ask to see any of these at the office. We will show you the certificate.</p>
    </header>

    <div class="certs">
      <article class="cert reveal" data-delay="1">
        <span class="cert__seal"><svg viewBox="0 0 24 24" class="ic"><path d="M12 2 4 6v6c0 5 3.4 8.6 8 10 4.6-1.4 8-5 8-10V6z"/></svg></span>
        <div><h3>Government-registered training centre</h3><p>Registered as a private language training institute.</p><p class="cert__ref">Reg. no. — to be supplied</p></div>
      </article>
      <article class="cert reveal" data-delay="2">
        <span class="cert__seal"><svg viewBox="0 0 24 24" class="ic"><circle cx="12" cy="8" r="5"/><path d="m8.5 12.5-1.5 8 5-3 5 3-1.5-8"/></svg></span>
        <div><h3>JLPT &amp; NAT-TEST preparation centre</h3><p>Registered to prepare and submit candidates for both Japanese proficiency examinations.</p><p class="cert__ref">Centre code — to be supplied</p></div>
      </article>
      <article class="cert reveal" data-delay="3">
        <span class="cert__seal"><svg viewBox="0 0 24 24" class="ic"><path d="M20 6 9 17l-5-5"/></svg></span>
        <div><h3>Registered study-abroad consultancy</h3><p>Licensed to process student admission and visa applications.</p><p class="cert__ref">Licence no. — to be supplied</p></div>
      </article>
      <article class="cert reveal" data-delay="4">
        <span class="cert__seal"><svg viewBox="0 0 24 24" class="ic"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M8 10h8M8 14h5"/></svg></span>
        <div><h3>IELTS registration support</h3><p>We handle candidate registration and venue booking on your behalf.</p><p class="cert__ref">Partner reference — to be supplied</p></div>
      </article>
    </div>

    <p class="partners__note" style="text-align:left;margin-top:var(--s5)">Replace each reference number with the real one, and link it to a scan of the certificate. An accreditation a visitor cannot verify is worth less than one you leave out.</p>
  </div>
</section>

<!-- ═══════ FACILITY ═══════ -->
<section class="section section--band" id="facility">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Our centre</p>
      <h2 data-en="Where you will actually study" data-bn="যেখানে আপনি পড়বেন">Where you will actually study</h2>
      <p class="sec-head__lede">Dhanmondi, two minutes from Dhanmondi 27. Walk in during office hours, or book a slot and a counsellor will be waiting.</p>
    </header>

    <div class="facility facility--page reveal" data-delay="1">
      <div class="facility__photo facility__photo--1"><span>Reception</span></div>
      <div class="facility__photo facility__photo--2"><span>Classroom</span></div>
      <div class="facility__photo facility__photo--3"><span>Language lab</span></div>
      <div class="facility__photo facility__photo--4"><span>Counselling room</span></div>
    </div>
    <p class="partners__note" style="text-align:left;margin-top:var(--s4)">Replace with real photographs of the centre.</p>

    <div class="info reveal" data-delay="2" style="margin-top:var(--s6);max-width:520px">
      <div class="info__card">
        <span class="info__icon info__icon--red">
          <svg viewBox="0 0 24 24" class="ic"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </span>
        <div>
          <h3>Dhaka office</h3>
          <address>House 00, Road 00, Dhanmondi<br>Dhaka 1205, Bangladesh</address>
          <p style="margin-top:8px"><a href="{{ route('contact') }}">See full contact details and map &rarr;</a></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ CTA ═══════ -->
<section class="cta" id="contact">
  <canvas class="cta__stars" id="ctaStars" aria-hidden="true"></canvas>
  <div class="wrap cta__inner">
    <div class="cta__copy reveal">
      <p class="eyebrow eyebrow--gold">Free, no obligation</p>
      <h2 data-en="Come and meet us" data-bn="আমাদের সাথে দেখা করুন">Come and meet us</h2>
      <p>Thirty minutes at the Dhanmondi office, or on the phone if you are outside Dhaka. You leave with a written plan — language level, exam date, application window, scholarship options, visa timeline and total cost — whether you enrol or not.</p>
      <ul class="cta__points">
        <li>Written cost estimate on the day</li>
        <li>Honest answer if none of the three countries fits</li>
        <li>Bangla or English, whichever you prefer</li>
      </ul>
    </div>

    <form class="cta__form reveal" data-delay="1" id="aboutLead" data-lead novalidate>
      <div class="field">
        <label for="a-name">Full name</label>
        <input type="text" id="a-name" name="name" required autocomplete="name" placeholder="Your name">
      </div>
      <div class="field">
        <label for="a-phone">Mobile number</label>
        <input type="tel" id="a-phone" name="phone" required autocomplete="tel" inputmode="tel" placeholder="01XXXXXXXXX">
      </div>
      <div class="field">
        <label for="a-interest">I want to talk about</label>
        <select id="a-interest" name="interest">
          <option>Japanese (JLPT)</option>
          <option>Korean (TOPIK)</option>
          <option>Chinese (HSK)</option>
          <option>IELTS preparation</option>
          <option>Study abroad &mdash; Japan</option>
          <option>Study abroad &mdash; Korea</option>
          <option>Study abroad &mdash; China</option>
        </select>
      </div>
      <button type="submit" class="btn btn--gold btn--block btn--lg">Book my free session</button>
      <p class="form__status" role="status" aria-live="polite"></p>
      <p class="cta__privacy">We call once. No spam, no selling your number.</p>
    </form>
  </div>
</section>
@endsection
