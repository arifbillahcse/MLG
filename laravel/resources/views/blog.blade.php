@extends('layouts.app')

@section('title', 'Blog — Multi Languages Gateway')
@section('description', 'Straight answers about studying in Japan: COE rejection reasons, real cost of living, JLPT planning, part-time work rules and IELTS band strategy.')

@section('og')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Blog — Multi Languages Gateway">
    <meta property="og:description" content="Straight answers about studying in Japan: COE rejection reasons, real cost of living, JLPT planning, part-time work rules and IELTS band strategy.">
@endsection

@section('content')
<section class="page-head">
  <div class="wrap">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span aria-hidden="true">/</span>
      <span aria-current="page">Blog</span>
    </nav>
    <h1 class="reveal" data-en="Read before you decide" data-bn="সিদ্ধান্ত নেওয়ার আগে পড়ুন">Read before you decide</h1>
    <p class="page-head__lede reveal" data-delay="1">Straight answers about studying in Japan — real costs, real timelines, and the reasons applications actually get rejected. Written by the counsellors who file these applications every intake.</p>
  </div>
</section>

<section class="section">
  <div class="wrap">

    <div class="chips reveal" role="group" aria-label="Filter posts by topic">
      <button type="button" class="chip is-active" data-filter="all">All posts</button>
      <button type="button" class="chip" data-filter="tips">Language learning tips</button>
      <button type="button" class="chip" data-filter="news">Study abroad news</button>
      <button type="button" class="chip" data-filter="visa">Visa &amp; immigration alerts</button>
      <button type="button" class="chip" data-filter="culture">Cultural insights</button>
      <button type="button" class="chip" data-filter="exams">Exam strategies</button>
    </div>

    <article class="featured reveal" data-cat="visa">
      <div class="featured__thumb"></div>
      <div>
        <span class="featured__tag">Featured · Visa</span>
        <h2><a href="#">The 7 most common COE rejection reasons — and how to avoid each one</a></h2>
        <p class="featured__meta">8 min read · Updated this intake</p>
        <p>Most rejections come down to paperwork, not the student. Financial sponsor mismatches, an unexplained study gap, an inconsistent statement of purpose — every one is preventable if you catch it before filing. We go through all seven with the fix for each.</p>
        <a href="#" class="btn btn--primary btn--sm">Read the guide</a>
      </div>
    </article>

    <div class="posts" id="postGrid">
      <article class="post reveal" data-delay="1" data-cat="visa">
        <div class="post__thumb post__thumb--4"><span class="post__cat">Visa</span></div>
        <h3><a href="#">Six documents that decide your COE application</a></h3>
        <p class="post__excerpt">Immigration reads your financial papers before anything else. Here is exactly what they look for, in the order they look.</p>
        <p class="post__meta mono">9 min read · Visa</p>
      </article>
      <article class="post reveal" data-delay="2" data-cat="news">
        <div class="post__thumb post__thumb--5"><span class="post__cat">Cost</span></div>
        <h3><a href="#">Part-time work in Japan: the 28-hour rule explained</a></h3>
        <p class="post__excerpt">What you can legally earn, what the permission endorsement is, and why students lose their status over this.</p>
        <p class="post__meta mono">7 min read · Cost</p>
      </article>
      <article class="post reveal" data-delay="3" data-cat="exams">
        <div class="post__thumb post__thumb--6"><span class="post__cat">JLPT</span></div>
        <h3><a href="#">JLPT vs NAT-TEST: which one should you sit?</a></h3>
        <p class="post__excerpt">Both are accepted by most language schools. The difference is timing, and it can cost you an intake.</p>
        <p class="post__meta mono">5 min read · JLPT</p>
      </article>
      <article class="post reveal" data-delay="1" data-cat="culture">
        <div class="post__thumb post__thumb--7"><span class="post__cat">Life</span></div>
        <h3><a href="#">Your first week in Japan: residence card, bank, phone</a></h3>
        <p class="post__excerpt">The three errands every new student has to run, and the order that saves you a second trip.</p>
        <p class="post__meta mono">8 min read · Life</p>
      </article>
      <article class="post reveal" data-delay="2" data-cat="exams">
        <div class="post__thumb post__thumb--8"><span class="post__cat">IELTS</span></div>
        <h3><a href="#">Why most Bangladeshi students plateau at band 6.5</a></h3>
        <p class="post__excerpt">It is almost never grammar. It is fluency under time pressure — and that is trainable.</p>
        <p class="post__meta mono">6 min read · IELTS</p>
      </article>
      <article class="post reveal" data-delay="3" data-cat="visa">
        <div class="post__thumb post__thumb--9"><span class="post__cat">Visa</span></div>
        <h3><a href="#">Study gap explained: how to write it so immigration accepts it</a></h3>
        <p class="post__excerpt">A gap is not a rejection. An unexplained gap is. A template and two real examples.</p>
        <p class="post__meta mono">10 min read · Visa</p>
      </article>
    </div>

    <p class="blog-empty" id="blogEmpty" hidden>No posts in this topic yet.</p>

    <nav class="pagination" aria-label="Pagination">
      <span class="is-disabled" aria-hidden="true">←</span>
      <span class="is-current" aria-current="page">1</span>
      <a href="#">2</a>
      <a href="#">3</a>
      <a href="#">→</a>
    </nav>

  </div>
</section>

<section class="cta">
  <canvas class="cta__stars" id="ctaStars" aria-hidden="true"></canvas>
  <div class="wrap cta__inner">
    <div class="cta__copy reveal">
      <p class="eyebrow eyebrow--gold">Still have a question?</p>
      <h2>An article can't read your documents</h2>
      <p>Bring your certificates, your bank statement and your target intake to a free 30-minute session. We'll tell you honestly whether the application stands up — and what to fix if it doesn't.</p>
      <ul class="cta__points">
        <li>Written cost estimate on the day</li>
        <li>Honest answer if Japan isn't right for you</li>
        <li>Bangla or English, whichever you prefer</li>
      </ul>
    </div>

    <form class="cta__form reveal" data-delay="1" id="blogLeadForm" data-lead novalidate>
      <div class="field">
        <label for="b-name">Full name</label>
        <input type="text" id="b-name" name="name" required autocomplete="name" placeholder="Your name">
      </div>
      <div class="field">
        <label for="b-phone">Mobile number</label>
        <input type="tel" id="b-phone" name="phone" required autocomplete="tel" inputmode="tel" placeholder="01XXXXXXXXX">
      </div>
      <div class="field">
        <label for="b-interest">I want to talk about</label>
        <select id="b-interest" name="interest">
          <option>Japanese language course</option>
          <option>Japan student visa</option>
          <option>IELTS preparation</option>
          <option>Other study destinations</option>
        </select>
      </div>
      <button type="submit" class="btn btn--gold btn--block btn--lg">Book my free session</button>
      <p class="form__status" role="status" aria-live="polite"></p>
      <p class="cta__privacy">We call once. No spam, no selling your number.</p>
    </form>
  </div>
</section>
@endsection
