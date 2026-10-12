<!-- ═══════════════ 13 · FAQ ═══════════════ -->
<section class="section section--band" id="faq">
  <div class="wrap wrap--narrow">
    <header class="sec-head sec-head--center reveal">
      <p class="eyebrow">FAQ</p>
      <h2 data-en="Questions we get every week" data-bn="প্রতি সপ্তাহে যেসব প্রশ্ন পাই">Questions we get every week</h2>
    </header>

    <div class="faq" id="faq-list">
      @foreach ($faqs as $faq)
      <div class="faq__item reveal">
        <button type="button" class="faq__q" aria-expanded="false">
          <span>{{ $faq->question }}</span>
          <span class="faq__icon" aria-hidden="true"></span>
        </button>
        <div class="faq__a"><p>{{ $faq->answer }}</p></div>
      </div>
      @endforeach
    </div>
  </section>
