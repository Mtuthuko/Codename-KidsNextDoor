/*
 * app-living.js: the calm falcon on the app's empty states.
 *
 * Loaded only where the brief allows a companion inside the app: the student and
 * faculty pages when they show no rows, and the EGO board when no clash is left
 * unresolved. Pages with data never load the kit. Options only; the kit
 * (living-layer.js) is a byte copy of the shared Living Layer 1.1.0.
 */
(function () {
  'use strict';
  if (!window.LivingLayer) return;

  // Two palettes from the Intaglio tokens: navy intaglio ink on paper, gold foil over night and navy.
  // On paper the tail and wingtips are ink-3 (5.4:1 on porcelain), so the barred tail reads.
  var INK  = { primary: '#22366A', secondary: '#5B6680', accent: '#D2AD62', dark: '#0A1631', light: '#F6F7F9' };
  var FOIL = { primary: '#D2AD62', secondary: '#E3C47F', accent: '#F6F7F9', dark: '#8A6418', light: '#F6F7F9' };
  var TOGGLE = { position: 'bottom-right', bg: '#0A1631', fg: '#D2AD62', line: 'rgba(210,173,98,.55)', label: 'Moving effects' };

  document.body.classList.add('has-living');

  // Cruise right beside the empty state it perches on (and enter from that side), so the falcon
  // never loiters over the rest of the screen: on the EGO board the other lane is full of cards.
  var lane = null, side = 'right';
  var target = document.querySelector('[data-perch]');
  if (target) {
    var r = target.getBoundingClientRect(), vw = window.innerWidth, vh = window.innerHeight;
    var clamp = function (v, lo, hi) { return Math.min(hi, Math.max(lo, v)); };
    if ((r.left + r.right) / 2 < vw * 0.45) side = 'left';
    lane = { x: clamp((r.right + 56) / vw, 0.08, 0.92), y: clamp((r.top - 28) / vh, 0.15, 0.8) };
  }

  var api = window.LivingLayer.init({
    character: 'falcon', look: 'rich', finish: 'foil', size: 58, calm: true, dust: false, side: side, lane: lane,
    colors: INK, colorsOnDark: FOIL, zIndex: 60, toggle: TOGGLE, intro: true, introDelay: 900
  });
  if (!api) return;

  // One celebration per browser session, only when the board really has no unresolved clash
  // (every clash resolved through the details form). Dragging never celebrates: it saves nothing.
  if (!document.querySelector('[data-celebrate="all-resolved"]')) return;
  var KEY = 'ks-all-resolved-celebrated', done = false;
  try { done = window.sessionStorage.getItem(KEY) === '1'; } catch (e) { /* storage blocked */ }
  if (done) return;

  // The falcon flies straight in and lands on "No unresolved clashes" (the login focus guard's
  // pattern: visit() before the intro only sets where it will fly), then celebrates once it has
  // perched, about 2.5 s after load, so the reward reads as one. celebrate() does nothing before
  // the intro has started, hence the wait for 'perched'; 20 s is only a safety net.
  var spot = document.querySelector('[data-celebrate] [data-perch]');
  if (spot) api.visit(spot);
  var tries = 0, timer = setInterval(function () {
    var s = api.state();
    if (s.enabled && s.mode === 'perched') {
      clearInterval(timer);
      api.celebrate();
      try { window.sessionStorage.setItem(KEY, '1'); } catch (e) { /* storage blocked */ }
    } else if (++tries > 80) {
      clearInterval(timer);   // gives up after 20 s (250 ms x 80)
    }
  }, 250);
})();
