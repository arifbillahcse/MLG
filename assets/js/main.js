/* ============================================================
   Multi Languages Gateway — homepage behaviour
   Vanilla JS, no dependencies. Every enhancement degrades safely:
   with JS disabled the page is fully readable and navigable.
   ============================================================ */
(function () {
  'use strict';

  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $  = function (s, c) { return (c || document).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

  /* ---------- 1. Scroll reveal ---------------------------------
     CSS keeps content visible by default; adding .anim-ready is what
     arms the animation, so a JS failure never hides the page. */
  function initReveal() {
    var items = $$('.reveal');
    if (!items.length) return;

    if (reduced || !('IntersectionObserver' in window)) {
      items.forEach(function (el) { el.classList.add('is-in'); });
      return;
    }

    document.body.classList.add('anim-ready');

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-in');
        io.unobserve(entry.target);
      });
    }, { rootMargin: '0px 0px -12% 0px', threshold: 0.12 });

    // Anything already in the first viewport plays its entrance immediately —
    // above-the-fold copy and the primary CTA must never wait on the observer.
    window.requestAnimationFrame(function () {
      items.forEach(function (el) {
        if (el.getBoundingClientRect().top < window.innerHeight * 0.95) {
          el.classList.add('is-in');
          io.unobserve(el);
        }
      });
    });

    items.forEach(function (el) { io.observe(el); });
  }

  /* ---------- 2. Sticky header state ---------- */
  function initHeader() {
    var header = $('#header');
    if (!header) return;
    var ticking = false;

    function update() {
      header.classList.toggle('is-stuck', window.scrollY > 8);
      ticking = false;
    }
    window.addEventListener('scroll', function () {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(update);
    }, { passive: true });
    update();
  }

  /* ---------- 3. Mobile menu + mega dropdowns ---------- */
  function initNav() {
    var burger = $('#burger');
    var nav = $('#nav');
    if (!burger || !nav) return;

    burger.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      burger.setAttribute('aria-expanded', String(open));
      burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
      document.body.style.overflow = open ? 'hidden' : '';
    });

    // close the menu when a link inside it is followed
    nav.addEventListener('click', function (e) {
      var link = e.target.closest('a[href^="#"]');
      if (!link || !nav.classList.contains('is-open')) return;
      nav.classList.remove('is-open');
      burger.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    });

    var items = $$('.nav__item.has-mega');

    items.forEach(function (item) {
      var trigger = $('.nav__link', item);

      trigger.addEventListener('click', function (e) {
        e.preventDefault();
        var open = item.classList.contains('is-open');
        items.forEach(function (i) {
          i.classList.remove('is-open');
          var t = $('.nav__link', i);
          if (t) t.setAttribute('aria-expanded', 'false');
        });
        if (!open) {
          item.classList.add('is-open');
          trigger.setAttribute('aria-expanded', 'true');
        }
      });

      // hover-open on pointer devices with room for the panel
      item.addEventListener('mouseenter', function () {
        if (window.matchMedia('(min-width:1051px)').matches) {
          item.classList.add('is-open');
          trigger.setAttribute('aria-expanded', 'true');
        }
      });
      item.addEventListener('mouseleave', function () {
        if (window.matchMedia('(min-width:1051px)').matches) {
          item.classList.remove('is-open');
          trigger.setAttribute('aria-expanded', 'false');
        }
      });
    });

    document.addEventListener('click', function (e) {
      if (e.target.closest('.nav__item.has-mega')) return;
      items.forEach(function (i) {
        i.classList.remove('is-open');
        var t = $('.nav__link', i);
        if (t) t.setAttribute('aria-expanded', 'false');
      });
    });

    document.addEventListener('keydown', function (e) {
      if (e.key !== 'Escape') return;
      items.forEach(function (i) { i.classList.remove('is-open'); });
      if (nav.classList.contains('is-open')) {
        nav.classList.remove('is-open');
        burger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });
  }

  /* ---------- 4. Hero word rotator ---------- */
  function initRotator() {
    var rot = $('#rotator');
    if (!rot || reduced) return;
    var items = $$('.rotator__item', rot);
    if (items.length < 2) return;
    var i = 0;

    setInterval(function () {
      var current = items[i];
      i = (i + 1) % items.length;
      var next = items[i];

      current.classList.add('is-out');
      current.classList.remove('is-active');
      next.classList.remove('is-out');
      next.classList.add('is-active');

      window.setTimeout(function () { current.classList.remove('is-out'); }, 520);
    }, 2600);
  }

  /* ---------- 5. Animated counters ---------- */
  function initCounters() {
    var counters = $$('.count');
    if (!counters.length) return;

    function run(el) {
      var target = parseFloat(el.dataset.target);
      var decimals = parseInt(el.dataset.decimals || '0', 10);
      if (reduced) { el.textContent = target.toFixed(decimals); return; }

      var duration = 1500;
      var start = null;

      function step(ts) {
        if (start === null) start = ts;
        var p = Math.min((ts - start) / duration, 1);
        // easeOutCubic
        var eased = 1 - Math.pow(1 - p, 3);
        var value = target * eased;
        el.textContent = decimals
          ? value.toFixed(decimals)
          : Math.round(value).toLocaleString('en-US');
        if (p < 1) window.requestAnimationFrame(step);
      }
      window.requestAnimationFrame(step);
    }

    if (!('IntersectionObserver' in window)) { counters.forEach(run); return; }

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        run(entry.target);
        io.unobserve(entry.target);
      });
    }, { threshold: 0.5 });
    counters.forEach(function (el) { io.observe(el); });
  }

  /* ---------- 6. Batch countdown ----------------------------------
     Counts to the next batch date. Change BATCH_START to the real
     date, or render it from a CMS field — never hardcode a past date. */
  function initCountdown() {
    var box = $('#countdown');
    if (!box) return;

    var BATCH_START = new Date('2026-10-12T10:00:00+06:00');

    // If the date has passed, roll forward a month so the demo never
    // shows a dead counter. In production, pull the next real batch.
    while (BATCH_START.getTime() < Date.now()) {
      BATCH_START.setMonth(BATCH_START.getMonth() + 1);
    }

    var out = {
      d: $('[data-cd="d"]', box),
      h: $('[data-cd="h"]', box),
      m: $('[data-cd="m"]', box),
      s: $('[data-cd="s"]', box)
    };

    function pad(n) { return String(n).padStart(2, '0'); }

    function tick() {
      var diff = Math.max(0, BATCH_START.getTime() - Date.now());
      var secs = Math.floor(diff / 1000);
      out.d.textContent = pad(Math.floor(secs / 86400));
      out.h.textContent = pad(Math.floor(secs / 3600) % 24);
      out.m.textContent = pad(Math.floor(secs / 60) % 60);
      out.s.textContent = pad(secs % 60);
    }

    tick();
    setInterval(tick, 1000);
  }

  /* ---------- 7. Sakura petals (hero canvas) ---------- */
  function initPetals() {
    var canvas = $('#petals');
    if (!canvas || reduced) return;

    var ctx = canvas.getContext('2d');
    var petals = [];
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    var w = 0, h = 0, raf = null, running = true;

    function size() {
      var rect = canvas.parentElement.getBoundingClientRect();
      w = rect.width; h = rect.height;
      canvas.width = w * dpr;
      canvas.height = h * dpr;
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }

    function seed() {
      var count = w < 700 ? 12 : 22;
      petals = [];
      for (var i = 0; i < count; i++) {
        petals.push({
          x: Math.random() * w,
          y: Math.random() * h,
          r: 4 + Math.random() * 6,
          sp: 0.25 + Math.random() * 0.6,
          drift: 0.3 + Math.random() * 0.8,
          a: Math.random() * Math.PI * 2,
          spin: (Math.random() - 0.5) * 0.02,
          o: 0.12 + Math.random() * 0.24
        });
      }
    }

    function petal(p) {
      ctx.save();
      ctx.translate(p.x, p.y);
      ctx.rotate(p.a);
      ctx.globalAlpha = p.o;
      ctx.fillStyle = '#D3372B';
      ctx.beginPath();
      // simple sakura petal: two curves meeting at a point
      ctx.moveTo(0, -p.r);
      ctx.quadraticCurveTo(p.r * 0.9, -p.r * 0.35, 0, p.r);
      ctx.quadraticCurveTo(-p.r * 0.9, -p.r * 0.35, 0, -p.r);
      ctx.fill();
      ctx.restore();
    }

    function frame(ts) {
      ctx.clearRect(0, 0, w, h);
      for (var i = 0; i < petals.length; i++) {
        var p = petals[i];
        p.y += p.sp;
        p.x += Math.sin((ts / 1400) + p.a) * p.drift * 0.4;
        p.a += p.spin;
        if (p.y - p.r > h) { p.y = -p.r * 2; p.x = Math.random() * w; }
        if (p.x < -20) p.x = w + 20;
        if (p.x > w + 20) p.x = -20;
        petal(p);
      }
      if (running) raf = window.requestAnimationFrame(frame);
    }

    size(); seed();
    raf = window.requestAnimationFrame(frame);

    var resizeTimer;
    window.addEventListener('resize', function () {
      window.clearTimeout(resizeTimer);
      resizeTimer = window.setTimeout(function () { size(); seed(); }, 200);
    });

    // stop painting when the hero has scrolled away — saves battery
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting && !running) {
            running = true;
            raf = window.requestAnimationFrame(frame);
          } else if (!e.isIntersecting && running) {
            running = false;
            window.cancelAnimationFrame(raf);
          }
        });
      }, { threshold: 0 }).observe(canvas.parentElement);
    }
  }

  /* ---------- 8. Drifting stars (final CTA canvas) ---------- */
  function initStars() {
    var canvas = $('#ctaStars');
    if (!canvas || reduced) return;

    var ctx = canvas.getContext('2d');
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    var stars = [], w = 0, h = 0, raf = null, running = false;

    function size() {
      var rect = canvas.parentElement.getBoundingClientRect();
      w = rect.width; h = rect.height;
      canvas.width = w * dpr;
      canvas.height = h * dpr;
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      stars = [];
      var count = Math.round((w * h) / 14000);
      for (var i = 0; i < count; i++) {
        stars.push({
          x: Math.random() * w,
          y: Math.random() * h,
          r: Math.random() * 1.4 + 0.3,
          v: 0.05 + Math.random() * 0.18,
          tw: Math.random() * Math.PI * 2
        });
      }
    }

    function frame(ts) {
      ctx.clearRect(0, 0, w, h);
      for (var i = 0; i < stars.length; i++) {
        var s = stars[i];
        s.x -= s.v;
        if (s.x < -3) { s.x = w + 3; s.y = Math.random() * h; }
        var alpha = 0.35 + Math.sin(ts / 900 + s.tw) * 0.3;
        ctx.globalAlpha = Math.max(0.08, alpha);
        ctx.fillStyle = i % 7 === 0 ? '#E8A33D' : '#FFFFFF';
        ctx.beginPath();
        ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
        ctx.fill();
      }
      if (running) raf = window.requestAnimationFrame(frame);
    }

    size();
    window.addEventListener('resize', size);

    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting && !running) {
            running = true;
            raf = window.requestAnimationFrame(frame);
          } else if (!e.isIntersecting && running) {
            running = false;
            window.cancelAnimationFrame(raf);
          }
        });
      }, { threshold: 0 }).observe(canvas.parentElement);
    } else {
      running = true;
      raf = window.requestAnimationFrame(frame);
    }
  }

  /* ---------- 9. Reviews carousel ---------- */
  function initReviews() {
    var track = $('#reviewTrack');
    var dotsBox = $('#reviewDots');
    if (!track) return;

    var slides = $$('.review', track);
    if (slides.length < 2) return;
    var index = 0;
    var timer = null;

    slides.forEach(function (_, i) {
      var dot = document.createElement('button');
      dot.type = 'button';
      dot.className = 'dot' + (i === 0 ? ' is-active' : '');
      dot.setAttribute('aria-label', 'Show review ' + (i + 1));
      dot.addEventListener('click', function () { go(i); restart(); });
      dotsBox.appendChild(dot);
    });

    var dots = $$('.dot', dotsBox);

    function go(n) {
      index = (n + slides.length) % slides.length;
      slides.forEach(function (s, i) { s.classList.toggle('is-active', i === index); });
      dots.forEach(function (d, i) { d.classList.toggle('is-active', i === index); });
    }

    function restart() {
      window.clearInterval(timer);
      if (!reduced) timer = window.setInterval(function () { go(index + 1); }, 6500);
    }

    $$('[data-rev]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        go(index + (btn.dataset.rev === 'next' ? 1 : -1));
        restart();
      });
    });

    restart();
  }

  /* ---------- 10. FAQ accordion ---------- */
  function initFaq() {
    $$('.faq__item').forEach(function (item) {
      var q = $('.faq__q', item);
      q.addEventListener('click', function () {
        var open = item.classList.contains('is-open');
        // single-open accordion
        $$('.faq__item.is-open').forEach(function (other) {
          other.classList.remove('is-open');
          $('.faq__q', other).setAttribute('aria-expanded', 'false');
        });
        if (!open) {
          item.classList.add('is-open');
          q.setAttribute('aria-expanded', 'true');
        }
      });
    });
  }

  /* ---------- 11. EN / বাংলা toggle -------------------------------
     Swaps any element carrying data-en and data-bn. Extend coverage by
     adding the pair of attributes to more elements — no JS change needed. */
  function initLang() {
    var buttons = $$('.lang__btn');
    if (!buttons.length) return;

    function apply(lang) {
      $$('[data-en][data-bn]').forEach(function (el) {
        var value = el.dataset[lang];
        if (!value) return;
        el.textContent = value;
      });
      document.documentElement.lang = lang === 'bn' ? 'bn' : 'en';
      buttons.forEach(function (b) { b.classList.toggle('is-active', b.dataset.lang === lang); });
      try { localStorage.setItem('mlg-lang', lang); } catch (err) { /* private mode */ }
    }

    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () { apply(btn.dataset.lang); });
    });

    var saved;
    try { saved = localStorage.getItem('mlg-lang'); } catch (err) { saved = null; }
    if (saved === 'bn') apply('bn');
  }

  /* ---------- 12. Forms -------------------------------------------
     Client-side validation only. Wire the fetch() to your CRM,
     Google Sheet, or WordPress REST endpoint before launch. */
  function initForms() {
    [['#seminarForm', '#seminarStatus'], ['#leadForm', '#leadStatus']].forEach(function (pair) {
      var form = $(pair[0]);
      var status = $(pair[1]);
      if (!form || !status) return;

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        status.className = 'form__status';

        var name = form.querySelector('input[name="name"]');
        var phone = form.querySelector('input[name="phone"]');
        var bdPhone = /^01[3-9]\d{8}$/;

        [name, phone].forEach(function (f) { f.removeAttribute('aria-invalid'); });

        if (!name.value.trim()) {
          name.setAttribute('aria-invalid', 'true');
          name.focus();
          status.textContent = 'Please enter your name.';
          status.classList.add('is-err');
          return;
        }
        if (!bdPhone.test(phone.value.replace(/[\s-]/g, ''))) {
          phone.setAttribute('aria-invalid', 'true');
          phone.focus();
          status.textContent = 'Enter a valid Bangladeshi mobile number, e.g. 01712345678.';
          status.classList.add('is-err');
          return;
        }

        var btn = form.querySelector('button[type="submit"]');
        var label = btn.textContent;
        btn.disabled = true;
        btn.textContent = 'Sending…';

        // TODO: replace with a real POST to your endpoint.
        window.setTimeout(function () {
          btn.disabled = false;
          btn.textContent = label;
          form.reset();
          status.textContent = 'Thank you. We will call you within one working day.';
          status.classList.add('is-ok');
        }, 700);
      });
    });
  }

  /* ---------- 13. Back to top ---------- */
  function initToTop() {
    var btn = $('#totop');
    if (!btn) return;
    var ticking = false;

    function update() {
      btn.classList.toggle('is-visible', window.scrollY > 700);
      ticking = false;
    }
    window.addEventListener('scroll', function () {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(update);
    }, { passive: true });

    btn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: reduced ? 'auto' : 'smooth' });
    });
  }

  /* ---------- 14. Footer year ---------- */
  function initYear() {
    var y = $('#year');
    if (y) y.textContent = String(new Date().getFullYear());
  }

  /* ---------- boot ---------- */
  function boot() {
    initReveal();
    initHeader();
    initNav();
    initRotator();
    initCounters();
    initCountdown();
    initPetals();
    initStars();
    initReviews();
    initFaq();
    initLang();
    initForms();
    initToTop();
    initYear();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
