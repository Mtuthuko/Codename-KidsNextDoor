/*
 * front-door.js: the night front door (welcome and login).
 *
 *   1. Builds the guilloche rosette once: four layers (ring, outer braid, inner braid,
 *      foil band) drawn by a polar-band formula, the way a geometric lathe engraves.
 *   2. Welcome, first visit this session: the Rosette Lift (GSAP 3.13). The rosette
 *      engraves itself, the plate and title arrive, then the rosette tips back and its
 *      layers separate in depth while a foil glint crosses it. About 2.8 s, once.
 *      Any key or tap skips to the end. The Login button is never hidden or dimmed.
 *   3. Welcome at rest: as the cover scrolls away the rosette tips further back and its
 *      layers spread apart; on a fine pointer the stage leans a few degrees toward it.
 *   4. Login: the rosette is drawn at rest, still, around the form.
 *   5. The falcon (Living Layer, options only), calm on login with a focus guard.
 *
 * Depth is drawn in 2D (brief section 7, the crispness and cost fallback): the stage is one
 * flat plane tipped back under the cover's perspective, and each layer takes the scale and
 * offset a real projection would give it at that tilt. The CSS rest pose is the same model.
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

  /* Falcon palettes from the Intaglio tokens: navy intaglio ink on paper, gold foil on night.
   * On paper the tail and wingtips are ink-3 (5.4:1 on porcelain), so the barred tail reads. */
  var INK  = { primary: '#22366A', secondary: '#5B6680', accent: '#D2AD62', dark: '#0A1631', light: '#F6F7F9' };
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

  /* The 2D depth model. Each layer sits DEPTH px off the stage plane (behind < 0 < in front).
   * Seen through the cover's 1400px perspective on a plane tipped back by `tilt`, a layer
   * shows at scale P / (P - z cos tilt), shifted by -z sin tilt: deeper layers sit smaller
   * and lower. The rest pose (tilt 14, spread 1) is written out in intaglio-front.css. */
  var P = 1400, TILT = 14, TILT_MAX = 24, SPREAD_MAX = 1.4;
  var DEPTH = { ring: -150, outer: -72, inner: 0, foil: 52 };

  // Writes the stage tilt and each layer's pose from `view`. GSAP owns `transform` on the stage
  // and on .ix-rosette-z. The pointer only turns the whole plane, a compositor-only change; the
  // layers' depth pose changes with the lift and the scroll tip. While it changes, each layer moves
  // as a bitmap on its own compositor layer; 0.8 s after it settles they paint back into the stage,
  // so an idle cover is a single layer (four full-screen layers under the dust cost a frame in two).
  function poseDriver(stage, view) {
    var rx = gsap.quickSetter(stage, 'rotationX', 'deg');
    var ry = gsap.quickSetter(stage, 'rotationY', 'deg');
    var zEls = stage.querySelectorAll('.ix-rosette-z');
    var layers = ORDER.map(function (name) {
      var z = stage.querySelector('[data-layer="' + name + '"] .ix-rosette-z');
      // quickSetter does not split the `scale` alias, so set both axes
      return z ? { d: DEPTH[name], y: gsap.quickSetter(z, 'y', 'px'), sx: gsap.quickSetter(z, 'scaleX'), sy: gsap.quickSetter(z, 'scaleY') } : null;
    }).filter(Boolean);
    var lastT = null, lastS = null, hotOn = false, hotT = 0;
    function hot() {
      if (!hotOn) { hotOn = true; gsap.set(zEls, { willChange: 'transform' }); }
      clearTimeout(hotT);
      hotT = setTimeout(function () { hotOn = false; gsap.set(zEls, { willChange: 'auto' }); }, 800);
    }
    return function draw() {
      var tilt = view.lift * (TILT + (TILT_MAX - TILT) * view.p);   // the plane: the lift and the scroll tip
      var spread = view.lift * (1 + (SPREAD_MAX - 1) * view.p);
      rx(tilt - view.lift * view.ny * 4);                            // the pointer leans it +-2 degrees
      ry(view.lift * view.nx * 6);                                   // and turns it +-3 degrees
      if (tilt === lastT && spread === lastS) return;
      if (lastT !== null) hot();                                     // the first, static pose stays painted in
      lastT = tilt; lastS = spread;
      var t = tilt * Math.PI / 180, c = Math.cos(t), sn = Math.sin(t);
      for (var i = 0; i < layers.length; i++) {
        var z = layers[i].d * spread, s = P / (P - z * c);
        layers[i].y(-z * sn * s);
        layers[i].sx(s);
        layers[i].sy(s);
      }
    };
  }

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
    var out = { paths: [], gradient: null };
    ORDER.forEach(function (name) {
      var layer = stage.querySelector('[data-layer="' + name + '"]');
      if (!layer) return;
      var svg = layer.querySelector('svg');
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
   * 2. Welcome: the Rosette Lift, then the scroll tip
   * ------------------------------------------------------------------- */
  function welcome() {
    var cover = document.querySelector('.ix-cover');
    var stage = document.querySelector('.ix-cover .ix-rosette-stage');
    var plate = document.querySelector('.ix-cover .ix-plate');
    var plateShadow = plate ? plate.querySelector('.ix-plate-shadow') : null;
    var title = document.querySelector('.ix-door-title');
    var rule = document.querySelector('.ix-cover .ix-foil-rule');
    var sheen = rule ? rule.querySelector('.ix-sheen') : null;
    if (!stage || !cover) return;

    var live = !!gsap && !reduce;   // GSAP drives the pose; otherwise the CSS rest pose holds
    var intro = live && root.classList.contains('door-intro');
    var r = buildRosette(stage, intro);
    // lift: the intro's 0..1; p: how far the cover has scrolled away, 0..1; nx, ny: pointer, -0.5..0.5
    var view = { lift: 1, p: 0, nx: 0, ny: 0 };
    var draw = live ? poseDriver(stage, view) : function () {};
    var tl = null, going = false;
    var paused = function () { return !!(window.__livingLayer && !window.__livingLayer.isEnabled()); };

    function settle() {
      try { window.sessionStorage.setItem('ks-door-seen', '1'); } catch (e) { /* storage blocked */ }
      if (gsap) gsap.set(stage, { clearProps: 'willChange' });
      goLive(true);
    }

    if (intro) {
      view.lift = 0;
      draw();   // flat until the lift
      tl = gsap.timeline({ defaults: { ease: 'expo.out' }, paused: true, onComplete: settle });
      tl.to(r.paths, {
          strokeDashoffset: 0, duration: 0.85, ease: 'power2.inOut', stagger: { each: 0.03 },
          onComplete: function () { gsap.set(r.paths, { clearProps: 'strokeDasharray,strokeDashoffset' }); }
        }, 0)
        .fromTo(plate, { autoAlpha: 0, y: 14, filter: 'blur(6px)' },
          { autoAlpha: 1, y: 0, filter: 'blur(0px)', duration: 0.9, clearProps: 'filter' }, 0.15)
        .fromTo(title, { autoAlpha: 0, y: 18 }, { autoAlpha: 1, y: 0, duration: 1 }, 0.45)
        .fromTo(rule, { scaleX: 0 }, { scaleX: 1, duration: 0.9, ease: 'power3.inOut' }, 0.85)
        // The lift: the rosette tips back 14 degrees and its layers separate in depth under the plate.
        .set(stage, { willChange: 'transform' }, 1.39)
        .to(view, { lift: 1, duration: 1.2, ease: 'power3.inOut', onUpdate: draw }, 1.4)
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
      // Repeat visit this session (or effects paused): no engraving; the stage settles in.
      if (live) gsap.fromTo(stage, { autoAlpha: 0 }, { autoAlpha: 1, duration: 0.3, ease: 'power1.out' });
      goLive(false);
    }

    // At rest the depth stays alive: the cover scrolling away tips the rosette from 14 to 24
    // degrees and spreads its layers (the scroll parallax, from the depth model), and a fine
    // pointer leans the stage +-3 degrees. Both hold still while moving effects are paused.
    function goLive(animate) {
      if (going || !live) return;
      going = true;
      var toP = gsap.quickTo(view, 'p', { duration: 0.5, ease: 'power3.out', onUpdate: draw });
      var coverH = cover.offsetHeight, lastP = -1;
      var scrolled = function () {
        var y = window.pageYOffset || document.documentElement.scrollTop || 0;
        return Math.min(1, Math.max(0, y / Math.max(1, coverH)));
      };
      var onScroll = function () {
        if (paused()) return;
        var p = scrolled();
        if (Math.abs(p - lastP) < 0.002) return;
        lastP = p;
        toP(p);
      };
      // Start from where the page already is: eased in after the intro, set at once otherwise.
      lastP = scrolled();
      if (animate) toP(lastP); else { view.p = lastP; draw(); }
      window.addEventListener('scroll', onScroll, { passive: true });
      window.addEventListener('resize', function () { coverH = cover.offsetHeight; lastP = -1; onScroll(); }, { passive: true });

      if (!mq('(hover: hover) and (pointer: fine)')) return;   // coarse pointers keep the still lean
      var toX = gsap.quickTo(view, 'nx', { duration: 0.6, ease: 'power3.out', onUpdate: draw });
      var toY = gsap.quickTo(view, 'ny', { duration: 0.6, ease: 'power3.out', onUpdate: draw });
      var sx = null, toSheen = gsap.utils.mapRange(-3, 3, -120, 340);
      if (sheen) {
        gsap.set(sheen, { x: 0, xPercent: -120 });
        sx = gsap.quickTo(sheen, 'xPercent', { duration: 0.6, ease: 'power3.out' });
      }
      window.addEventListener('pointermove', function (e) {
        if (e.pointerType && e.pointerType !== 'mouse' && e.pointerType !== 'pen') return;
        if (paused()) return;
        var nx = e.clientX / window.innerWidth - 0.5, ny = e.clientY / window.innerHeight - 0.5;
        toX(nx);
        toY(ny);
        if (sx) sx(toSheen(nx * 6));
      }, { passive: true });
    }

    // The falcon: full on the welcome page. It arrives as the lift settles. On phones it
    // cruises in the clear night above the plate, never on the title's last letters.
    if (window.LivingLayer) {
      window.LivingLayer.init({
        character: 'falcon', look: 'rich', finish: 'foil', size: 72, side: 'right',
        colors: INK, colorsOnDark: FOIL, zIndex: 60, toggle: TOGGLE,
        intro: true, introDelay: intro ? 2400 : 600,
        lane: phone ? { x: 0.86, y: 0.1 } : null,
        perch: narrowTitle ? '[data-perch]:not(.ix-door-title)' : '[data-perch]',
        dust: { colors: DUST, amount: 0.5, ambient: true, trail: true }
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
      character: 'falcon', look: 'rich', finish: 'foil', size: 64, side: 'right', calm: true,
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
