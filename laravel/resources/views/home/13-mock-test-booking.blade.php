<!-- ═══════════════ 15 · MOCK TEST BOOKING ═══════════════ -->
<section class="section section--band" id="mock">
  <div class="wrap">
    <div class="seminar">
      <div class="seminar__copy reveal">
        <p class="eyebrow">Free mock test</p>
        <h2 data-en="Find out your real level first" data-bn="আগে নিজের আসল লেভেল জানুন">Find out your real level first</h2>
        <p class="sec-head__lede">Sit a full-length mock before you pay for anything. You get a written score breakdown and an honest recommendation on which level to start at — even if that answer is "you don't need our course yet".</p>
        <dl class="seminar__meta">
          @foreach ($mockTests as $mock)
            <div><dt>{{ Str::of($mock->title)->after('Free ')->before(' ')->upper() }}</dt><dd>{{ Str::of($mock->title)->after('Free ') }}</dd></div>
          @endforeach
        </dl>
      </div>

      <form class="seminar__form reveal" data-delay="1" id="mockForm" data-lead novalidate>
        <h3>Book your free mock</h3>
        <div class="field">
          <label for="m-name">Full name</label>
          <input type="text" id="m-name" name="name" required autocomplete="name" placeholder="Your name">
        </div>
        <div class="field">
          <label for="m-phone">Mobile number</label>
          <input type="tel" id="m-phone" name="phone" required autocomplete="tel" inputmode="tel" placeholder="01XXXXXXXXX">
          <small class="field__hint">We confirm your slot by SMS.</small>
        </div>
        <div class="field">
          <label for="m-exam">Which test?</label>
          <select id="m-exam" name="exam">
            @foreach ($mockTests as $mock)
              <option>{{ $mock->title }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn--primary btn--block">Book free mock test</button>
        <p class="form__status" role="status" aria-live="polite"></p>
      </form>
    </div>
  </div>
</section>
