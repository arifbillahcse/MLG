<!-- ═══════════════ 13 · SUCCESS STORIES ═══════════════ -->
<section class="section" id="stories">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Success stories</p>
      <h2 data-en="Students who already flew" data-bn="যারা ইতিমধ্যে উড়ে গেছেন">Students who already flew</h2>
    </header>

    <div class="stories">
      <div class="stories__videos">
        @foreach ($videoStories as $i => $story)
        <article class="vcard reveal" data-delay="{{ $i + 1 }}">
          <div class="vcard__thumb vcard__thumb--{{ $story->thumb_variant ?: '1' }}"
               @if ($story->thumbnail) style="background-image:url('{{ asset('storage/'.$story->thumbnail) }}');background-size:cover" @endif>
            <button type="button" class="vcard__play" aria-label="Play testimonial from {{ $story->student_name }}"
                    @if ($story->video_url) data-video="{{ $story->video_url }}" @endif>
              <svg viewBox="0 0 24 24" class="ic ic--fill"><path d="M8 5v14l11-7z"/></svg>
            </button>
          </div>
          <h3>{{ $story->student_name }}</h3>
          <p class="vcard__meta">{{ $story->meta }}</p>
        </article>
        @endforeach
      </div>

      <div class="reviews reveal" data-delay="2">
        <div class="reviews__head">
          <div>
            <p class="reviews__score"><b class="mono">{{ $settings['google_rating'] ?? '' }}</b> <span class="stars" aria-label="4.9 out of 5">★★★★★</span></p>
            <p class="reviews__count">Based on {{ $settings['google_reviews'] ?? '0' }} Google reviews</p>
          </div>
          <a href="#" class="reviews__link">Write a review</a>
        </div>

        <div class="reviews__viewport">
          <ul class="reviews__track" id="reviewTrack">
            @foreach ($reviews as $review)
            <li class="review{{ $loop->first ? ' is-active' : '' }}">
              <p class="review__text">{{ $review->quote }}</p>
              <p class="review__by"><b>{{ $review->student_name }}</b> · {{ $review->meta }}</p>
            </li>
            @endforeach
          </ul>
        </div>

        <div class="reviews__nav">
          <button type="button" class="rbtn" data-rev="prev" aria-label="Previous review"><svg viewBox="0 0 24 24" class="ic"><path d="m15 18-6-6 6-6"/></svg></button>
          <div class="dots" id="reviewDots"></div>
          <button type="button" class="rbtn" data-rev="next" aria-label="Next review"><svg viewBox="0 0 24 24" class="ic"><path d="m9 18 6-6-6-6"/></svg></button>
        </div>
      </div>
    </div>
  </div>
</section>
