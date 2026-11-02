/*
 * board-notes.js: progressive enhancement for the EGO clash board.
 *
 * ego_dashboard.js keeps doing the real drag-and-drop (drag, allowDrop, drop).
 * This file only adds feedback around it:
 *   - the dragged card dims, and the Resolved lane shows it can receive the card;
 *   - while dragging, the lane's children ignore the pointer, so drop() always
 *     receives #resolved itself as its target;
 *   - an unresolved card dropped into Resolved gets a note: moving a card does not
 *     save anything, the status only changes through View details.
 *
 * It never edits ego_dashboard.js, never touches dataTransfer and never calls
 * preventDefault. Every listener sits on document, so it survives Vue re-rendering #app.
 */
(function () {
  'use strict';

  var NOTE = 'Moved on this screen only. Open View details to change the status.';

  function zone() { return document.getElementById('resolved'); }

  function element(node) {
    return node && node.nodeType !== 1 ? node.parentElement : node;
  }

  function clear() {
    var els = document.querySelectorAll('.is-dragging, .is-receiving, .is-target');
    for (var i = 0; i < els.length; i++) els[i].classList.remove('is-dragging', 'is-receiving', 'is-target');
  }

  document.addEventListener('dragstart', function (e) {
    var t = element(e.target);
    var card = t && t.closest ? t.closest('[draggable="true"][ondragstart]') : null;
    if (!card) return;
    card.classList.add('is-dragging');
    // Next frame: changing pointer-events during dragstart itself can cancel the drag.
    requestAnimationFrame(function () {
      var z = zone();
      if (z) z.classList.add('is-receiving');
    });
  }, true);

  document.addEventListener('dragenter', function (e) {
    var z = zone();
    if (z && e.target === z) z.classList.add('is-target');
  });

  document.addEventListener('dragleave', function (e) {
    var z = zone();
    if (z && e.target === z && !(e.relatedTarget && z.contains(e.relatedTarget))) z.classList.remove('is-target');
  });

  // Bubble phase: runs after the inline ondrop="drop(event)" has moved the card.
  document.addEventListener('drop', function () {
    setTimeout(function () {
      var z = zone();
      if (z) {
        var cards = z.querySelectorAll('[draggable="true"]');
        var card = cards[cards.length - 1];
        if (card && card.getAttribute('data-status') === '1' && !card.querySelector('.ix-moved-note')) {
          card.classList.add('is-moved');
          var note = document.createElement('p');
          note.className = 'ix-moved-note';
          note.setAttribute('role', 'status');
          note.innerHTML = '<svg class="ix-i" aria-hidden="true" focusable="false"><use href="/images/icons.svg#i-info"></use></svg><span></span>';
          note.lastChild.textContent = NOTE;
          var top = card.querySelector('.ix-clash-top');
          if (top && top.nextSibling) card.insertBefore(note, top.nextSibling);
          else card.appendChild(note);
        }
      }
      clear();
    }, 0);
  });

  document.addEventListener('dragend', clear, true);
})();
