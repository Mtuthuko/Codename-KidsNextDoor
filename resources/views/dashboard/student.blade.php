@extends('layouts.app')

@section('content')
@php $ixQ = trim((string) request('search')); @endphp

<div class="ix-page-head">
    <h1 class="ix-h1">Exams Schedule</h1>

    <form class="ix-search" action="exam" method="get" role="search">
        <label class="ix-label" for="search">Enter course code</label>
        <div class="ix-search-row">
            <div class="ix-input-wrap">
                @include('partials.icon', ['name' => 'search'])
                <input id="search" type="search" name="search" class="ix-input ix-input-search" placeholder="Enter Course Code" value="{{ request('search') }}" autocomplete="off" spellcheck="false">
            </div>
            <button type="submit" class="ix-btn ix-btn-primary">@include('partials.icon', ['name' => 'search'])Search</button>
        </div>
    </form>
</div>

@if ($ixQ !== '')
    <p class="ix-results" v-pre>Results for “<strong>{{ request('search') }}</strong>” · <a href="@auth{{ url('/home') }}@else{{ url('exam') }}@endauth">Show all</a></p>
@endif

<div class="ix-register" v-pre>
@if (count($bookings) === 0)
    <div class="ix-empty">
        <img class="ix-seal" src="/images/seal.svg" alt="" width="96" height="96">
        @if ($ixQ !== '')
            <h2 class="ix-empty-title" data-perch>No exams found for “{{ $ixQ }}”</h2>
            <p class="ix-empty-text">Check the course code and search again.</p>
            <a class="ix-btn ix-btn-secondary" href="@auth{{ url('/home') }}@else{{ url('exam') }}@endauth">Show all exams</a>
        @else
            <h2 class="ix-empty-title" data-perch>No exams scheduled yet</h2>
        @endif
    </div>
    @push('living')<script src="/js/living-layer.js" defer></script><script src="/js/app-living.js" defer></script>@endpush
@else
    <div class="ix-register-scroll ix-register-scroll--exams" role="region" aria-label="Exams Schedule" tabindex="0">
        <table class="ix-table ix-table--exams" role="table">
            <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">COURSE CODE</th>
                    <th scope="col" role="columnheader">COURSE DESCRIPTION</th>
                    <th scope="col" role="columnheader">ASSESSMENT TYPE</th>
                    <th scope="col" role="columnheader">VENUE</th>
                    <th scope="col" role="columnheader">EXAM DATE</th>
                    <th scope="col" role="columnheader">EXAM TIME</th>
                    <th scope="col" role="columnheader">DURATION</th>
                    <th scope="col" role="columnheader" class="ix-num">SIZE</th>
                    <th scope="col" role="columnheader" class="ix-num">CONCURRENT EXAMS</th>
                </tr>
            </thead>
            <tbody role="rowgroup">
                {{-- Populating the table with data from the EXAMS table in the database --}}
                @foreach ($bookings as $exam)
                    @php
                        $ixDate = trim((string) $exam['exam_date']); $ixWd = null;
                        if (preg_match('/^\d{4}-\d{2}-\d{2}/', $ixDate)) {
                            try { $ixWd = \Carbon\Carbon::createFromFormat('Y-m-d', substr($ixDate, 0, 10))->format('D'); } catch (\Exception $e) { $ixWd = null; }
                        }
                        $ixS = null; $ixL = null;
                        if (preg_match('/^(\d{1,2}):(\d{2})/', trim((string) $exam['start_time']), $m1)
                            && preg_match('/^(\d+)\s*H$/i', trim((string) $exam['duration']), $m2)) {
                            $ixS = max(0, min(1, ((int) $m1[1] + (int) $m1[2] / 60 - 8) / 12));
                            $ixL = max(0, min(1 - $ixS, (int) $m2[1] / 12));
                        }
                    @endphp
                    <tr role="row">
                        <td role="cell" class="ix-c-code" data-label="Course code">@include('partials.code-mark', ['raw' => $exam['course_code'], 'delay' => min($loop->index * 30, 240)])</td>
                        <td role="cell" class="ix-c-desc" data-label="Course description">{{ $exam['description'] }}</td>
                        <td role="cell" class="ix-c-type" data-label="Assessment type"><span class="ix-chip">{{ $exam['exam_type'] }}</span></td>
                        <td role="cell" class="ix-c-venue" data-label="Venue">{{ $exam['venue'] }}</td>
                        <td role="cell" class="ix-c-date" data-label="Exam date">@if ($ixWd)<span class="ix-wd">{{ $ixWd }}</span> @endif<span class="ix-t">{{ $exam['exam_date'] }}</span></td>
                        <td role="cell" class="ix-c-time" data-label="Exam time"><span class="ix-t ix-time">{{ $exam['start_time'] }}</span>@if ($ixS !== null)<span class="ix-day-rule" aria-hidden="true" style="--s:{{ number_format($ixS, 4, '.', '') }};--l:{{ number_format($ixL, 4, '.', '') }}"><i></i></span>@endif</td>
                        <td role="cell" class="ix-c-dur ix-t" data-label="Duration">{{ $exam['duration'] }}</td>
                        <td role="cell" class="ix-c-size ix-num" data-label="Size">{{ $exam['size'] }}</td>
                        <td role="cell" class="ix-c-conc ix-num" data-label="Concurrent exams">{{ $exam['concurrent_exams'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
</div>
@endsection
