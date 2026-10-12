<!-- ═══════════════ 14 · FINAL CTA ═══════════════ -->
<section class="cta" id="contact">
  <canvas class="cta__stars" id="ctaStars" aria-hidden="true"></canvas>
  <div class="wrap cta__inner">
    <div class="cta__copy reveal">
      <p class="eyebrow eyebrow--gold">Free, no obligation</p>
      <h2 data-en="Let's map your route in 30 minutes" data-bn="৩০ মিনিটে আপনার রুট ঠিক করি">Let's map your route in 30 minutes</h2>
      <p>Tell us where you are today — school certificate, budget, target country and intake — and we'll write down the whole path: language level, exam date, application window, scholarship options, visa timeline and total cost. You leave with the plan whether you enrol or not.</p>
      <ul class="cta__points">
        <li>Written cost estimate on the day</li>
        <li>Honest answer if none of the three countries fits</li>
        <li>Bangla or English, whichever you prefer</li>
      </ul>
    </div>

    <form class="cta__form reveal" data-delay="1" id="leadForm" data-lead novalidate>
      <div class="field">
        <label for="c-name">Full name</label>
        <input type="text" id="c-name" name="name" required autocomplete="name" placeholder="Your name">
      </div>
      <div class="field">
        <label for="c-phone">Mobile number</label>
        <input type="tel" id="c-phone" name="phone" required autocomplete="tel" inputmode="tel" placeholder="01XXXXXXXXX" pattern="^01[3-9][0-9]{8}$">
      </div>
      <div class="field">
        <label for="c-interest">I want to talk about</label>
        <select id="c-interest" name="interest">
          @foreach ($courses as $course)
            <option>{{ $course->name }}@if ($course->exam_name) ({{ $course->exam_name }})@endif</option>
          @endforeach
          @foreach ($destinations as $destination)
            <option>{{ $destination->name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn--gold btn--block btn--lg">Book my free session</button>
      <p class="form__status" id="leadStatus" role="status" aria-live="polite"></p>
      <p class="cta__privacy">We call once. No spam, no selling your number.</p>
    </form>
  </div>
</section>
