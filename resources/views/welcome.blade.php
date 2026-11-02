@extends('layouts.layout')

@section('page', 'welcome')

@section('content')
{{-- 1. Cover: the guilloche rosette (drawn by /js/front-door.js) behind the porcelain Wits plate --}}
<section class="ix-cover" aria-labelledby="door-title">
    <div class="ix-rosette-stage" aria-hidden="true">
        <div class="ix-rosette-layer" data-layer="ring" data-depth="0.04"><div class="ix-rosette-z"><svg viewBox="-600 -600 1200 1200" focusable="false"></svg></div></div>
        <div class="ix-rosette-layer" data-layer="outer" data-depth="0.08"><div class="ix-rosette-z"><svg viewBox="-600 -600 1200 1200" focusable="false"></svg></div></div>
        <div class="ix-rosette-layer" data-layer="inner" data-depth="0.12"><div class="ix-rosette-z"><svg viewBox="-600 -600 1200 1200" focusable="false"></svg></div></div>
        <div class="ix-rosette-layer" data-layer="foil" data-depth="0.16"><div class="ix-rosette-z"><svg viewBox="-600 -600 1200 1200" focusable="false"></svg></div></div>
    </div>

    <div class="ix-cover-stack">
        <div class="ix-plate">
            <span class="ix-plate-shadow" aria-hidden="true"></span>
            <img src="/images/wits-logo.png" alt="University of the Witwatersrand, Johannesburg" width="300" height="106">
        </div>

        <h1 id="door-title" class="ix-door-title" data-perch>Exam Scheduler</h1>

        <span class="ix-foil-rule" aria-hidden="true"><span class="ix-sheen"></span></span>

        @if (Route::has('login'))
            @auth
                <a class="ix-btn-foil" href="{{ url('/home') }}" data-magnetic data-perch="corner">Home @include('partials.icon', ['name' => 'arrow-right'])</a>
            @else
                <a class="ix-btn-foil" href="{{ route('login') }}" data-magnetic data-perch="corner">Login @include('partials.icon', ['name' => 'arrow-right'])</a>

                {{-- @if (Route::has('register')) <a href="{{ route('register') }}">Register</a> @endif --}}
            @endauth
        @endif
    </div>
</section>

{{-- 2. Specimen sheet: what each role sees after logging in (the views' real labels, no demo data) --}}
<section class="ix-specimen" aria-labelledby="after-title">
    <div class="ix-specimen-in">
        <div data-reveal-3d>
            <h2 id="after-title" class="ix-specimen-title">After you log in</h2>
        </div>

        <div class="ix-band" data-reveal-3d>
            <div class="ix-band-role">
                <h3 class="ix-band-name" data-perch>Students</h3>
                <p class="ix-band-view">Exams Schedule</p>
            </div>
            <div class="ix-band-body">
                <ul class="ix-band-labels">
                    <li>Course code</li> <li>Course description</li> <li>Assessment type</li> <li>Venue</li> <li>Exam date</li> <li>Exam time</li> <li>Duration</li> <li>Size</li> <li>Concurrent exams</li>
                </ul>
                <p class="ix-band-text">Search the schedule by course code.</p>
            </div>
        </div>

        <div class="ix-band-border" aria-hidden="true"></div>

        <div class="ix-band" data-reveal-3d>
            <div class="ix-band-role">
                <h3 class="ix-band-name" data-perch>Faculty staff</h3>
                <p class="ix-band-view">Exam Bookings</p>
            </div>
            <div class="ix-band-body">
                <ul class="ix-band-labels">
                    <li>Course code</li> <li>Course name</li> <li>Size</li> <li>AM/PM</li> <li>Duration</li> <li>Paper number</li> <li>Special req: table</li> <li>Special req: venue</li>
                </ul>
                <p class="ix-band-text">Edit the number of students and special requests, or delete a booking.</p>
            </div>
        </div>

        <div class="ix-band-border" aria-hidden="true"></div>

        <div class="ix-band" data-reveal-3d>
            <div class="ix-band-role">
                <h3 class="ix-band-name" data-perch>EGO staff</h3>
                <p class="ix-band-view">View Clashes</p>
            </div>
            <div class="ix-band-body">
                <ul class="ix-band-labels">
                    <li>Unresolved</li> <li>Resolved</li>
                </ul>
                <p class="ix-band-text">Open View details to change a clash’s status.</p>
            </div>
        </div>
    </div>
</section>

{{-- 3. Close --}}
<section class="ix-door-close">
    <span class="ix-foil-rule ix-foil-rule--close" aria-hidden="true"></span>
    @if (Route::has('login'))
        @auth
            <a class="ix-btn-foil" href="{{ url('/home') }}" data-perch="corner">Home @include('partials.icon', ['name' => 'arrow-right'])</a>
        @else
            <a class="ix-btn-foil" href="{{ route('login') }}" data-perch="corner">Login @include('partials.icon', ['name' => 'arrow-right'])</a>
        @endauth
    @endif
</section>
@endsection
