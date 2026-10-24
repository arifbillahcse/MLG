<!-- ═══════════════ 16 · PRICING ═══════════════ -->
<section class="section" id="pricing">
  <div class="wrap">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow">Transparent pricing</p>
      <h2 data-en="Every fee, in public" data-bn="প্রতিটি ফি, প্রকাশ্যে">Every fee, in public</h2>
      <p class="sec-head__lede">No competitor in this market publishes a number. We do — it saves your time and ours.</p>
    </header>

    @php
      // The online column only earns its place when some level actually has
      // an online fee. Otherwise it is a column of dashes.
      $showOnline = $courses->pluck('levels')->flatten()->whereNotNull('fee_online')->isNotEmpty();
    @endphp

    <div class="fee-table reveal" data-delay="1">
      <h3 class="fee-table__title">Course fees</h3>
      <div class="tbl-scroll">
        <table class="tbl">
          <caption class="sr-only">Course fees by language and level</caption>
          <thead>
            <tr>
              <th scope="col">Course</th>
              <th scope="col">Level</th>
              <th scope="col">Duration</th>
              <th scope="col" class="ta-r">Price</th>
              <th scope="col" class="ta-r">Discount price</th>
              @if ($showOnline)
                <th scope="col" class="ta-r">Online</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($courses as $course)
              @foreach ($course->levels as $level)
                <tr>
                  <th scope="row">{{ $course->name }}</th>
                  <td>{{ $level->code }}</td>
                  <td>{{ $level->months_label }} months</td>
                  <td class="ta-r mono {{ $level->hasDiscount() ? 'is-struck' : '' }}">
                    {{ $level->regular_fee ? '৳ '.number_format($level->regular_fee) : '—' }}
                  </td>
                  <td class="ta-r mono">
                    {{ $level->hasDiscount() ? '৳ '.number_format($level->final_fee) : '—' }}
                  </td>
                  @if ($showOnline)
                    <td class="ta-r mono">{{ $level->fee_online ? '৳ '.number_format($level->fee_online) : '—' }}</td>
                  @endif
                </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
      <p class="fee-table__note">Fees include course materials and in-house mock tests. Exam registration fees (JLPT, TOPIK, HSK, IELTS) are paid directly to the exam body and are not included. Study-abroad application and visa service charges are quoted separately after your consultation.</p>
    </div>
  </div>
</section>
