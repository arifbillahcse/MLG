{{-- Reusable closing CTA. Pass $formId (unique on the page) and $formSlug
     (the source_form recorded against the enquiry). --}}
<section class="cta" id="contact">
  <canvas class="cta__stars" id="ctaStars" aria-hidden="true"></canvas>
  <div class="wrap cta__inner">
    <div class="cta__copy reveal">
      <p class="eyebrow eyebrow--gold">Free, no obligation</p>
      <h2>{{ $ctaHeading ?? "Let's map your route in 30 minutes" }}</h2>
      <p>{{ $ctaBody ?? 'Tell us where you are today — school certificate, budget, target country and intake — and we will write down the whole path: language level, exam date, application window, scholarship options, visa timeline and total cost. You leave with the plan whether you enrol or not.' }}</p>
      <ul class="cta__points">
        <li>Written cost estimate on the day</li>
        <li>Honest answer if none of the three countries fits</li>
        <li>Bangla or English, whichever you prefer</li>
      </ul>
    </div>

    <form class="cta__form reveal" data-delay="1" id="{{ $formId }}" method="POST"
          action="{{ route('enquiry.store') }}" data-lead novalidate>
      @include('partials.form.head', ['form' => $formSlug])

      <div class="field">
        <label for="{{ $formId }}-name">Full name</label>
        <input type="text" id="{{ $formId }}-name" name="name" required autocomplete="name"
               placeholder="Your name" value="{{ old('name') }}"
               @error('name') aria-invalid="true" @enderror>
      </div>
      <div class="field">
        <label for="{{ $formId }}-phone">Mobile number</label>
        <input type="tel" id="{{ $formId }}-phone" name="phone" required autocomplete="tel"
               inputmode="tel" placeholder="01XXXXXXXXX" value="{{ old('phone') }}"
               @error('phone') aria-invalid="true" @enderror>
      </div>
      <div class="field">
        <label for="{{ $formId }}-interest">I want to talk about</label>
        <select id="{{ $formId }}-interest" name="interest">
          @foreach ($courses as $course)
            <option>{{ $course->name }}@if ($course->exam_name) ({{ $course->exam_name }})@endif</option>
          @endforeach
          <option>Study abroad &amp; visa</option>
        </select>
      </div>

      <button type="submit" class="btn btn--gold btn--block btn--lg">Book my free session</button>
      @include('partials.form.status', ['form' => $formSlug])
      <p class="cta__privacy">We call once. No spam, no selling your number.</p>
    </form>
  </div>
</section>
