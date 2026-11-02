# Design: Intaglio

The Wits Exam Scheduler is designed like a **security-printed document**. Degree
certificates and banknotes share one craft, intaglio engraving: guilloche
rosettes drawn by a lathe, navy ink pressed into porcelain paper, a foil that
glints when you tilt it, and an engraved animal guarding the document. That
craft says "this cannot be forged", which is also what an exam schedule
promises: the venue and time you see are the real ones.

- **Front door** (welcome, login): a night-navy cover where a guilloche rosette
  engraves itself and lifts into 3D behind a porcelain plate carrying the Wits
  logo. One foil-gold button. A falcon flies in and perches beside the title.
- **Inside the app** (schedules, bookings, the clash board, forms): calm
  porcelain pages with a navy app bar, white tables with tabular figures, an
  engraved day-rule under each exam time and seal-style status chips. Gold only
  marks what is *yours*: your search match, your focused row, the drop target,
  focus halos.

Expensive comes from restraint: one accent (foil), one display face used
sparingly, hairlines instead of boxes, and motion that happens once and then
stays still.

## Where things live

| File | What it holds |
|---|---|
| `public/css/intaglio.css` | **All tokens** (`:root`), the base reset, and every app component. Linked by both layouts. |
| `public/css/intaglio-front.css` | The front door only: cover, rosette stage, plate, foil button, "After you log in" sheet, login card. |
| `public/js/front-door.js` | Builds the rosette, runs the Rosette Lift, the pointer tilt, and the falcon on welcome and login. |
| `public/js/app-living.js` | The calm falcon on app empty states and the one EGO celebration. |
| `public/js/board-notes.js` | Drag feedback on the EGO board (it never changes `ego_dashboard.js`). |
| `public/js/living-layer.js` | The Living Layer kit, a byte copy of the shared kit. Never edit it here. |
| `public/images/icons.svg` | The icon sprite (24px grid, 1.5px strokes). |
| `public/images/seal.svg`, `guilloche-strip.svg`, `public/favicon.svg` | Generated guilloche artwork. |
| `resources/views/partials/icon.blade.php` | `@include('partials.icon', ['name' => 'search'])` prints one icon. |
| `resources/views/partials/code-mark.blade.php` | Wraps the searched part of a course code in a foil `<mark>`. |

`public/css/app.css` (Bootstrap 4, hand-edited in 2020) stays linked on app
pages because the user dropdown needs it. **Never edit it**; `intaglio.css`
comes after it and undoes its old body and form rules under `body.ix`.

## Tokens

All colours, fonts, spacing, radii, shadows and easing are CSS custom
properties at the top of `intaglio.css`. Use the variable, never a raw value.

| Group | Tokens | Used for |
|---|---|---|
| Night | `--night` `#0A1631`, `--night-lift`, `--engrave`, `--ring`, `--mist`, `--mist-2` | The front-door ground, rosette lines, text on night |
| Foil | `--foil` `#D2AD62`, `--foil-hi`, `--foil-sheen`, `--foil-ink`, `--foil-line` | The one accent: foil button, keylines, rules, "yours" marks. Gold is never text on light grounds (about 2:1) |
| Paper | `--porcelain`, `--canvas`, `--surface`, `--surface-2`, `--rule`, `--field`, `--chip-line` | App grounds, tables, cards, inputs, hairlines |
| Ink | `--ink` `#0F1B33`, `--ink-2`, `--ink-3` | Body and data text, secondary text, meta |
| Navy | `--navy` `#0B3865` (the repo's own Wits navy), `--navy-press`, `--navy-tint` | App bar, primary buttons, links, focus outline on light |
| Status | `--unresolved` / `-tint`, `--resolved` / `-tint`, `--note-ink` / `--note-tint` | Always icon + word, never colour alone |
| Marks | `--hover`, `--wash`, `--mark`, `--selection`, `--halo` | Row hover, focused row, search match, text selection, focus halo |
| Space | `--s-1` 4px … `--s-24` 96px | A 4px scale |
| Radius | `--r-plate` 3px, `--r-control` 4px, `--r-surface` 6px | Chips and plates; inputs and buttons; tables, cards, panels |
| Shadow | `--shadow-1`, `--shadow-2`, `--shadow-plate` | Panels; dropdown and dragged card; the welcome plate and login card |
| Motion | `--ease-out` `cubic-bezier(.16,1,.3,1)`, `--t-fast` 150ms, `--t-base` 200ms | Every transition |

The foil gold is sampled from the crest in the repo's logo. Neither the navy
nor the gold is presented as an official Wits palette.

## Type

- **Noto Serif Display** (300–500): the display voice. Only for the cover
  title, page names (H1/H2), panel titles, role names and the app-bar name.
  Never for labels, buttons or data, never below 20px.
- **Public Sans** (400–700): everything you work with: labels, body, buttons,
  inputs and all table data. Data uses tabular figures through `.ix-t`.
- Both load from Google Fonts in each layout's `<head>`.
- App sizes are fixed rem (H1 2.25rem, body 1rem, table cells .9375rem, table
  headers .75rem uppercase). The front door uses fluid `clamp()` sizes.
- `text-transform` only ever touches table headers and small label lines,
  never data, usernames, clash text or status words.

## Components (all classes start with `ix-`)

- **Shell:** `ix-appbar` (navy bar, foil rule, the hanging porcelain logo plate
  `ix-plate-tab`, the user menu `ix-usermenu`), `ix-page`, `ix-appfoot`, the
  `ix-skip` link.
- **Headings:** `ix-h1`, `ix-h2`, `ix-subtitle`, `ix-panel-title`, and
  `ix-page-head` (title left, search or toolbar right).
- **Buttons:** `ix-btn` plus `ix-btn-primary` (navy), `ix-btn-secondary`
  (outlined navy), `ix-btn-danger` (Delete), `ix-btn-quiet` (a dashed
  placeholder that must never look like a working action), `ix-btn-block`.
  The front door has `ix-btn-foil`.
- **Forms:** `ix-field` > `ix-label` + `ix-input` / `ix-select`, errors in
  `ix-field-error` (tied with `aria-describedby`), `ix-check` for checkboxes,
  `ix-search` for the course-code search.
- **Feedback:** `ix-banner--success` / `--error`, `ix-moved-note`.
- **Data:** `ix-register` > `ix-register-scroll` > `table.ix-table`. Below
  720px every row becomes a card (labels come from each cell's `data-label`).
  Chips: `ix-chip`, `ix-chip-slot` (AM/PM), `ix-chip-any`. Status:
  `ix-status--unresolved` / `--resolved` with a seal icon. Counts: `ix-count`.
- **Signature details:** `ix-day-rule` (the engraved 08:00–20:00 scale under an
  exam time), `mark.ix-hit` (the foil search match).
- **Board:** `ix-board`, `ix-lane`, `ix-clash` cards (the drag hooks
  `draggable`, `ondragstart="drag(event)"` and `#resolved` must stay exactly).
- **Panels and empty states:** `ix-panel`, `ix-panel--cert` (the certificate
  keyline), `ix-empty` with the guilloche seal.

## Motion

- **One authored moment:** the Rosette Lift on the first welcome visit of a
  session (GSAP 3.13 from cdnjs). The rosette engraves itself, the plate and
  title arrive, then it tips back and separates into four depth layers while a
  foil glint crosses it (about 2.8s, once; any key or tap skips it). The Login
  button is never hidden or dimmed.
- **App pages:** CSS only, 150–250ms state changes (colour, background, the
  dropdown, the search mark drawing in once). No page-load choreography.
- **Reduced motion:** no timeline, tilt, parallax or view transition; the
  rosette is drawn complete and still at its 3D rest tilt; the falcon starts
  paused. Content is identical with or without motion or JavaScript.

## The falcon (Living Layer)

**Character: `falcon`.** Precision and focus are the exam virtues, and in an
intaglio world the falcon plays the engraved animal vignette that guards a
banknote or certificate, so it belongs to the document rather than sitting on
top of it as a mascot. It is drawn in two palettes from the tokens: navy
intaglio ink over paper, gold foil over night (`colors` and `colorsOnDark`).

**Where it appears** (the kit script is loaded only here):

| Page | How |
|---|---|
| Welcome `/` | Full falcon with sparse gold dust; perches beside the title (screens 600px and wider), on the Login button's corner, and beside the role names |
| Login | Calm falcon; it goes to the card title as soon as a field has focus and stays there, clear of the form |
| Student or faculty page with **no rows** | Calm, no dust, perches beside the empty-state title |
| EGO board with **no unresolved clash** | Calm, no dust, perches on "No unresolved clashes" and celebrates once per browser session |

It never appears on tables, forms, the board with work on it, the edit page,
the clash form, register or the password pages. Dragging a card never
celebrates, because a drag saves nothing.

**How to change it:** options live in `LivingLayer.init({...})` calls:

- `public/js/front-door.js`: welcome (`size: 60`, dust `amount: 0.3`) and login
  (`size: 56`, `calm: true`). Change `character`, `size`, `dust`, `perch` or
  `introDelay` there.
- `public/js/app-living.js`: the app empty states (`size: 52`, `calm: true`,
  `dust: false`, and a cruising `lane` beside the empty-state title).
- Palettes (`INK`, `FOIL`, `DUST`, `TOGGLE`) are at the top of both files.
- Mark perch spots in Blade with `data-perch` (or `data-perch="corner"` for a
  button). 3D touches: `data-depth` on the rosette layers, `data-reveal-3d` on
  the welcome bands, `data-magnetic` on the cover button.
- Every page that loads the kit has the round pause button bottom-right
  ("Moving effects"); the visitor's choice is remembered.
- To update the kit, copy the shared `living-layer.js` over
  `public/js/living-layer.js` unchanged; never call `setEnabled()` from code
  (it saves a choice as if the visitor made it).

## How to add a new page in this style

1. `@extends('layouts.app')` and put the content in `@section('content')`.
   The layout already gives you the app bar, `main#content.ix-page` (with
   `v-pre`, so Vue never evaluates `{{ }}` in your data) and the footer.
2. Start with a head: `<div class="ix-page-head"><h1 class="ix-h1">…</h1> … </div>`.
   One `h1` per page; headings in order.
3. Build from the components above. Forms: one `ix-field` per control, every
   control with a `<label for>`, errors in `ix-field-error`. Data: an
   `ix-register` table with `th scope="col"` and a `data-label` on every cell
   so it turns into cards on phones.
4. Icons come from `@include('partials.icon', ['name' => '…'])`. Never use
   emoji or Unicode arrows as icons.
5. Scripts go in `@push('scripts')`, never inside the content (Vue removes
   `<script>` tags inside `#app`).
6. Use tokens only. Gold marks something that is *yours*; it is never
   decoration on working screens.
7. Check it at 1440px and 390px, with the keyboard, and with reduced motion.

## Rules that keep the app working

- Keep every route, form action, field name (`username`, `special_request_vanue`
  and the rest), the role redirect and the drag hooks exactly as they are.
- Never run npm, composer or artisan cache commands against the repo, and
  never edit `app.css`, `app.js` or `ego_dashboard.js`.
- PHP must stay 7.2-compatible (no `match`, `?->`, `str_contains`), and Blade
  must stay Laravel 7 (no `@class` or `@selected`).
