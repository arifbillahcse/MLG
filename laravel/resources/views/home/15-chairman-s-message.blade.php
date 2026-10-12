<!-- ═══════════════ 17 · CHAIRMAN'S MESSAGE ═══════════════ -->
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

        @foreach (preg_split('/\n\s*\n/', (string) ($chairman->body ?? '')) as $para)
          <p class="chairman__text">{{ trim($para) }}</p>
        @endforeach

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
