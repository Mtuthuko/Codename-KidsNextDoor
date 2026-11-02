@extends('layouts.app')

@section('content')
@php $ixQ = trim((string) request('search')); @endphp

{{-- Look up a course in the database --}}
<div class="ix-page-head">
    <h1 class="ix-h1">Exam Bookings</h1>

    <form class="ix-search" action="exambooking" method="get" role="search">
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
    <p class="ix-results" v-pre>Results for “<strong>{{ request('search') }}</strong>” · <a href="{{ url('exambooking') }}">Show all</a></p>
@endif

@if($message = Session::get('success'))
    <div class="ix-banner ix-banner--success" role="status">
        @include('partials.icon', ['name' => 'check-circle'])
        <p>{{ $message }}</p>
    </div>
@endif

{{-- Course codes with the number of students registered for each course --}}
<h2 class="ix-h2 ix-section-title">Courses Data</h2>

<div class="ix-register" v-pre>
@if (count($posts) === 0)
    <div class="ix-empty">
        <img class="ix-seal" src="/images/seal.svg" alt="" width="96" height="96">
        @if ($ixQ !== '')
            <h3 class="ix-empty-title" data-perch>No courses found for “{{ $ixQ }}”</h3>
            <p class="ix-empty-text">Check the course code and search again.</p>
            <a class="ix-btn ix-btn-secondary" href="{{ url('exambooking') }}">Show all courses</a>
        @else
            <h3 class="ix-empty-title" data-perch>No courses yet</h3>
        @endif
    </div>
    @push('living')<script src="/js/living-layer.js" defer></script><script src="/js/app-living.js" defer></script>@endpush
@else
    <div class="ix-register-scroll ix-register-scroll--courses" role="region" aria-label="Courses Data" tabindex="0">
        <table class="ix-table ix-table--courses" role="table">
            <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">Course code</th>
                    <th scope="col" role="columnheader">Course Name</th>
                    <th scope="col" role="columnheader" class="ix-num">Size</th>
                    <th scope="col" role="columnheader">AM/PM</th>
                    <th scope="col" role="columnheader">Duration</th>
                    <th scope="col" role="columnheader">Paper number</th>
                    <th scope="col" role="columnheader">Special req: table</th>
                    <th scope="col" role="columnheader">Special req: venue</th>
                    <th scope="col" role="columnheader"><span class="ix-vh">Actions</span></th>
                </tr>
            </thead>
            <tbody role="rowgroup">
                @foreach($posts as $row)
                    <tr role="row">
                        <td role="cell" class="ix-c-code" data-label="Course code">@include('partials.code-mark', ['raw' => $row['code'], 'delay' => min($loop->index * 30, 240)])</td>
                        <td role="cell" class="ix-c-name" data-label="Course name">{{ $row['name'] }}</td>
                        <td role="cell" class="ix-c-size ix-num" data-label="Size">{{ $row['size'] }}</td>
                        <td role="cell" class="ix-c-slot" data-label="AM/PM">@if ($row['time'] === 'AM' || $row['time'] === 'PM')<span class="ix-chip ix-chip-slot">{{ $row['time'] }}</span>@else<span class="ix-chip ix-chip-any">{{ $row['time'] }}</span>@endif</td>
                        <td role="cell" class="ix-c-dur ix-t" data-label="Duration">{{ $row['duration'] }}</td>
                        <td role="cell" class="ix-c-paper ix-t" data-label="Paper number">{{ $row['paperno'] }}</td>
                        <td role="cell" class="ix-c-stable" data-label="Special req: table">@if (trim((string) $row['special_request_table']) === 'None')<span class="ix-none">{{ $row['special_request_table'] }}</span>@else{{ $row['special_request_table'] }}@endif</td>
                        <td role="cell" class="ix-c-svenue" data-label="Special req: venue">@if (trim((string) $row['special_request_vanue']) === 'None')<span class="ix-none">{{ $row['special_request_vanue'] }}</span>@else{{ $row['special_request_vanue'] }}@endif</td>
                        <td role="cell" class="ix-c-acts">
                            <div class="ix-row-actions">
                                <a class="ix-btn ix-btn-secondary" href="{{ route('editpage', $row['id']) }}">@include('partials.icon', ['name' => 'pencil'])Edit<span class="ix-vh"> {{ $row['code'] }}</span></a>
                                <form class="ix-row-delete" action="{{ route('deletionpage', $row['id']) }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="ix-btn ix-btn-danger">@include('partials.icon', ['name' => 'trash'])Delete<span class="ix-vh"> {{ $row['code'] }}</span></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
</div>
@endsection
