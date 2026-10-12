<!-- ═══════════════ 04 · COURSE GRID ═══════════════ -->
<section class="section" id="courses">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Courses</p>
      <h2 data-en="Four courses, two ways to study" data-bn="চারটি কোর্স, দুইভাবে শেখার সুযোগ">Four courses, two ways to study</h2>
      <p class="sec-head__lede">Every course runs as a live in-class batch and as a recorded online course. Same syllabus, same instructors, same certificate — you pick the format that fits your week.</p>
    </header>

    <div class="courses">
      @foreach ($courses as $i => $course)
      <article class="course{{ $course->is_test_prep ? ' course--test' : '' }} reveal" data-delay="{{ $i + 1 }}">
        <span class="course__rail" aria-hidden="true"></span>
        <span class="course__glyph">{{ $course->glyph }}</span>
        <h3>{{ $course->t('name') }}</h3>
        <p class="course__native">{{ $course->native_name }}</p>
        @if ($course->exam_name)
          <span class="course__exam">{{ $course->exam_name }}</span>
        @endif
        <p class="course__desc">{{ $course->t('description') }}</p>
        <div class="course__levels">
          @foreach ($course->levels as $level)
            <span class="level">{{ $level->code }}</span>
          @endforeach
        </div>
        <div class="modes">
          @if ($course->offers_online)
            <span class="mchip"><svg viewBox="0 0 24 24" class="ic"><rect x="2" y="4" width="20" height="13" rx="2"/><path d="M8 21h8"/></svg>Online</span>
          @endif
          @if ($course->offers_in_class)
            <span class="mchip"><svg viewBox="0 0 24 24" class="ic"><path d="M3 21V8l9-5 9 5v13"/><path d="M9 21v-6h6v6"/></svg>In class</span>
          @endif
        </div>
        @if ($course->price_from)
          <p class="course__price">From <b>৳ {{ number_format($course->price_from) }}</b></p>
        @endif
        <a href="{{ route('courses.show', $course) }}" class="btn {{ $course->is_test_prep ? 'btn--secondary' : 'btn--primary' }} btn--block btn--sm">Course details</a>
      </article>
      @endforeach
    </div>
  </div>
</section>
