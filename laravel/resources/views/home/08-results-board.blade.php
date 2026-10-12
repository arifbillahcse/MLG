<!-- ═══════════════ 10 · RESULTS BOARD ═══════════════ -->
<section class="section section--band" id="results">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Top scores</p>
      <h2 data-en="Results from the last two intakes" data-bn="গত দুই ইনটেকের ফলাফল">Results from the last two intakes</h2>
      <p class="sec-head__lede">Published with each student's permission. Ask in a consultation and we'll show you the full board.</p>
    </header>

    <div class="results">
      @foreach ($results as $i => $result)
      <div class="result reveal" data-delay="{{ intdiv($i, 2) + 1 }}">
        <span class="result__exam">{{ $result->exam }}</span>
        <p class="result__score">{{ $result->score }}</p>
        <p class="result__name">{{ $result->student_name }}</p>
        <p class="result__meta">{{ $result->meta }}</p>
      </div>
      @endforeach
</section>
