/*
 * front-door.js: the night front door (welcome and login).
 *
 *   1. Builds the guilloche rosette once: four layers (ring, outer braid, inner braid,
 *      foil band) drawn by a polar-band formula, the way a geometric lathe engraves.
 *   2. Welcome, first visit this session: the Rosette Lift (GSAP 3.13). The rosette
 *      engraves itself, the plate and title arrive, then the rosette tips back and
 *      separates into real 3D layers while a foil glint crosses it. About 2.8 s, once.
 *      Any key or tap skips to the end. The Login button is never hidden or dimmed.
 *   3. Welcome at rest: the stage leans a few degrees toward a fine pointer.
 *   4. Login: the rosette is drawn at rest, still, around the form.
 *   5. The falcon (Living Layer, options only), calm on login with a focus guard.
 *
 * Reduced motion, no GSAP or no JavaScript: everything is visible at its rest state.
 * Branches on <html data-page>; does nothing on other pages.
 */
(function () {
  'use strict';

  var root = document.documentElement;
  var page = root.getAttribute('data-page');
  if (page !== 'welcome' && page !== 'login') return;

  // Cross-document view transitions run only between the two front-door pages (the plate
  // becomes the login card's logo). Into the app, which does not opt in, skip it cleanly.
  window.addEventListener('pageswap', function (e) {
    if (!e.viewTransition) return;
    var to = e.activation && e.activation.entry && e.activation.entry.url;
    var where = '';
    try { where = to ? new URL(to).pathname : ''; } catch (err) { where = ''; }
    if (where !== '/' && where !== '/login') e.viewTransition.skipTransition();
  });

  var mq = function (q) { return window.matchMedia ? window.matchMedia(q).matches : false; };
  var reduce = mq('(prefers-reduced-motion: reduce)');
  var phone = mq('(max-width: 719.98px)');
  var narrowTitle = mq('(max-width: 599.98px)');
  var gsap = window.gsap;

  /* Falcon palettes from the Intaglio tokens: navy intaglio ink on paper, gold foil on night. */
  var INK  = { primary: '#22366A', secondary: '#AEB9CF', accent: '#D2AD62', dark: '#0A1631', light: '#F6F7F9' };
  var FOIL = { primary: '#D2AD62', secondary: '#E3C47F', accent: '#F6F7F9', dark: '#8A6418', light: '#F6F7F9' };
  var DUST = ['#D2AD62', '#E3C47F', '#F6F7F9'];
  var TOGGLE = { position: 'bottom-right', bg: '#0A1631', fg: '#D2AD62', line: 'rgba(210,173,98,.55)', label: 'Moving effects' };

  /* ---------------------------------------------------------------------
   * 1. The rosette
   * ------------------------------------------------------------------- */
  var NS = 'http://www.w3.org/2000/svg';
  var BANDS = {
    inner: [{ r0: 338, amp: 14, n: 40, lines: 9, cls: 'ix-g-ink' }],
    foil:  [{ r0: 414, amp: 36, n: 30, lines: 12, cls: 'ix-g-ink' }, { r0: 414, amp: 36, n: 30, lines: 2, cls: 'ix-g-foil', off: 0.5 }],
    outer: [{ r0: 500, amp: 20, n: 56, lines: 8, cls: 'ix-g-ink' }],
    ring:  [{ r0: 560, amp: 0, n: 0, lines: 1, cls: 'ix-g-ring' }]
  };
  var ORDER = ['inner', 'foil', 'outer', 'ring'];               // engraving order
  var REST_Z = { ring: -90, outer: -40, inner: 0, foil: 24 };   // matches intaglio-front.css

  // One braided band: `lines` closed paths, each phase-shifted by 2pi/lines.
  function band(svg, b, perLobe, ringSteps) {
    var made = [];
    for (var k = 0; k < b.lines; k++) {
      var ph = (k + (b.off || 0)) * 2 * Math.PI / b.lines / (b.n || 1);
      var steps = b.n ? b.n * perLobe : ringSteps, d = '';
      for (var i = 0; i <= steps; i++) {
        var th = i / steps * 2 * Math.PI;
        var r = b.r0 + b.amp * Math.sin(b.n * th + ph * b.n) * (0.82 + 0.18 * Math.cos(3 * th));
        d += (i ? 'L' : 'M') + (r * Math.cos(th)).toFixed(1) + ' ' + (r * Math.sin(th)).toFixed(1);
      }
      var p = document.createElementNS(NS, 'path');
      p.setAttribute('d', d + 'Z');
      p.setAttribute('class', b.cls);
      svg.appendChild(p);
      made.push(p);
    }
    return made;
  }

  // The foil threads' gradient: a 400-unit bright band parked off to the left;
  // outside it the threads read as plain foil at .26.
  function foilGradient(svg) {
    var defs = document.createElementNS(NS, 'defs');
    var g = document.createElementNS(NS, 'linearGradient');
    g.setAttribute('id', 'ix-foil');
    g.setAttribute('gradientUnits', 'userSpaceOnUse');
    g.setAttribute('x1', '-1400'); g.setAttribute('y1', '0');
    g.setAttribute('x2', '-1000'); g.setAttribute('y2', '0');
    [['0', '#D2AD62', '.26'], ['.5', '#FFF4D6', '.85'], ['1', '#D2AD62', '.26']].forEach(function (s) {
      var stop = document.createElementNS(NS, 'stop');
      stop.setAttribute('offset', s[0]);
      stop.setAttribute('stop-color', s[1]);
      stop.setAttribute('stop-opacity', s[2]);
      g.appendChild(stop);
    });
    defs.appendChild(g);
    svg.insertBefore(defs, svg.firstChild);
    return g;
  }

  // Builds every layer. With `dashed`, each path is created already hidden behind
  // its dash, so nothing flashes before the engraving starts.
  function buildRosette(stage, dashed) {
    var perLobe = phone ? 8 : 24, ringSteps = phone ? 120 : 240;
    // Dash lengths are in screen units under non-scaling-stroke and in path units
    // otherwise; size them for whichever is longer, with a small margin.
    var dashScale = Math.max(1, (stage.offsetWidth || 1200) / 1200) * 1.06;
    var out = { paths: [], zs: {}, gradient: null };
    ORDER.forEach(function (name) {
      var layer = stage.querySelector('[data-layer="' + name + '"]');
      if (!layer) return;
      var svg = layer.querySelector('svg');
      out.zs[name] = layer.querySelector('.ix-rosette-z');
      if (name === 'foil') out.gradient = foilGradient(svg);
      BANDS[name].forEach(function (b) {
        band(svg, b, perLobe, ringSteps).forEach(function (p) {
          if (dashed) {
            var L = Math.ceil(p.getTotalLength() * dashScale) + 2;
            p.style.strokeDasharray = L + ' ' + L;
            p.style.strokeDashoffset = L;
          }
          out.paths.push(p);
        });
      });
    });
    return out;
  }

  /* ---------------------------------------------------------------------
   * 2. Welcome: the Rosette Lift
   * ------------------------------------------------------------------- */
  function welcome() {
    var stage = document.querySelector('.ix-cover .ix-rosette-stage');
    var plate = document.querySelector('.ix-cover .ix-plate');
    var plateShadow = plate ? plate.querySelector('.ix-plate-shadow') : null;
    var title = document.querySelector('.ix-door-title');
    var rule = document.querySelector('.ix-cover .ix-foil-rule');
    var sheen = rule ? rule.querySelector('.ix-sheen') : null;
    if (!stage) return;

    var intro = root.classList.contains('door-intro') && !!gsap && !reduce;
    var r = buildRosette(stage, intro);
    var zs = ORDER.map(function (n) { return r.zs[n]; }).filter(Boolean);
    var tl = null;

    function markSeen() {
      try { window.sessionStorage.setItem('ks-door-seen', '1'); } catch (e) { /* storage blocked */ }
      if (gsap) gsap.set([stage].concat(zs), { clearProps: 'willChange' });
      tilt();
    }

    if (intro) {
      tl = gsap.timeline({ defaults: { ease: 'expo.out' }, paused: true, onComplete: markSeen });
      tl.to(r.paths, {
          strokeDashoffset: 0, duration: 0.85, ease: 'power2.inOut', stagger: { each: 0.03 },
          onComplete: function () { gsap.set(r.paths, { clearProps: 'strokeDasharray,strokeDashoffset' }); }
        }, 0)
        .fromTo(plate, { autoAlpha: 0, y: 14, filter: 'blur(6px)' },
          { autoAlpha: 1, y: 0, filter: 'blur(0px)', duration: 0.9, clearProps: 'filter' }, 0.15)
        .fromTo(title, { autoAlpha: 0, y: 18 }, { autoAlpha: 1, y: 0, duration: 1 }, 0.45)
        .fromTo(rule, { scaleX: 0 }, { scaleX: 1, duration: 0.9, ease: 'power3.inOut' }, 0.85)
        // The lift: the rosette tips back and its layers separate in depth under the plate.
        .set([stage].concat(zs), { willChange: 'transform' }, 1.39)
        .fromTo(stage, { rotationX: 0 }, { rotationX: 8, duration: 1.2, ease: 'power3.inOut' }, 1.4)
        .fromTo(zs, { z: 0 }, {
            z: function (i, el) { return REST_Z[el.parentNode.getAttribute('data-layer')] || 0; },
            duration: 1.2, ease: 'power3.inOut'
          }, 1.4)
        .fromTo(plate, { z: 0 }, { z: 36, duration: 1.2, ease: 'power3.inOut' }, 1.4)
        .fromTo(plateShadow, { autoAlpha: 0 }, { autoAlpha: 1, duration: 1.2, ease: 'power3.inOut' }, 1.4)
        // The foil shifts: one security-foil glint across the rule and the foil threads.
        .fromTo(sheen, { x: 0, xPercent: -120 }, { xPercent: 340, duration: 1.2, ease: 'sine.inOut' }, 1.6)
        .fromTo(r.gradient, { attr: { x1: -1400, x2: -1000 } }, { attr: { x1: 1000, x2: 1400 }, duration: 1.2, ease: 'sine.inOut' }, 1.6);

      // The from-states are applied; CSS no longer needs to hold them hidden.
      root.classList.remove('door-intro');

      var skip = function () { if (tl && tl.progress() < 1) tl.progress(1); };
      ['keydown', 'pointerdown'].forEach(function (type) {
        window.addEventListener(type, skip, { once: true, passive: true });
      });

      var played = false;
      var play = function () { if (!played) { played = true; tl.play(); } };
      if (document.fonts && document.fonts.ready) document.fonts.ready.then(play, play);
      setTimeout(play, 1200);   // never wait long for fonts
    } else {
      root.classList.remove('door-intro');
      // Repeat visit this session: no engraving; the stage settles in.
      if (gsap && !reduce) gsap.fromTo(stage, { autoAlpha: 0 }, { autoAlpha: 1, duration: 0.3, ease: 'power1.out' });
      tilt();
    }

    // At rest, the stage leans toward a fine pointer (mouse or trackpad), +-3 degrees.
    var tilting = false;
    function tilt() {
      if (tilting || !gsap || reduce || !mq('(hover: hover) and (pointer: fine)')) return;
      tilting = true;
      var rx = gsap.quickTo(stage, 'rotationX', { duration: 0.6, ease: 'power3.out' });
      var ry = gsap.quickTo(stage, 'rotationY', { duration: 0.6, ease: 'power3.out' });
      var sx = null, toSheen = gsap.utils.mapRange(-3, 3, -120, 340);
      if (sheen) {
        gsap.set(sheen, { x: 0, xPercent: -120 });
        sx = gsap.quickTo(sheen, 'xPercent', { duration: 0.6, ease: 'power3.out' });
      }
      window.addEventListener('pointermove', function (e) {
        if (e.pointerType && e.pointerType !== 'mouse' && e.pointerType !== 'pen') return;
        if (window.__livingLayer && !window.__livingLayer.isEnabled()) return;   // paused: hold still
        var nx = e.clientX / window.innerWidth - 0.5, ny = e.clientY / window.innerHeight - 0.5;
        var y = nx * 6;
        ry(y);
        rx(8 - ny * 4);
        if (sx) sx(toSheen(y));
      }, { passive: true });
    }

    // The falcon: full on the welcome page. It arrives as the lift settles.
    if (window.LivingLayer) {
      window.LivingLayer.init({
        character: 'falcon', look: 'rich', finish: 'foil', size: 60, side: 'right',
        colors: INK, colorsOnDark: FOIL, zIndex: 60, toggle: TOGGLE,
        intro: true, introDelay: intro ? 2400 : 600,
        perch: narrowTitle ? '[data-perch]:not(.ix-door-title)' : '[data-perch]',
        dust: { colors: DUST, amount: 0.3, ambient: true, trail: true }
      });
    }
  }

  /* ---------------------------------------------------------------------
   * 3. Login: still rosette, calm falcon, focus guard
   * ------------------------------------------------------------------- */
  function login() {
    root.classList.remove('door-intro');
    var stage = document.querySelector('.ix-cover .ix-rosette-stage');
    if (stage) buildRosette(stage, false);

    if (!window.LivingLayer) return;
    window.LivingLayer.init({
      character: 'falcon', look: 'rich', finish: 'foil', size: 56, side: 'right', calm: true,
      colors: INK, colorsOnDark: FOIL, zIndex: 60, toggle: TOGGLE, intro: true, introDelay: 700,
      lane: phone ? { x: 0.84, y: 0.055 } : null,
      dust: { colors: DUST, amount: 0.15, ambient: false, trail: true }
    });

    // Once a field has focus, send the falcon to the card title and let it stay there:
    // calm mode never wanders, so it never crosses the fields.
    var title = document.querySelector('.ix-login-title');
    var form = document.querySelector('.ix-login-form');
    var sent = false;
    function guard() {
      if (!sent && window.__livingLayer && title) { sent = true; window.__livingLayer.visit(title); }
    }
    if (form) {
      form.addEventListener('focusin', guard);
      if (form.contains(document.activeElement)) guard();
    }
  }

  try {
    if (page === 'welcome') welcome(); else login();
  } catch (err) {
    root.classList.remove('door-intro');   // never leave the cover hidden
    if (window.console) console.error(err);
  }
})();
