@extends('layouts.app')

@section('content')
@php
    $ixUnresolved = $clashes->filter(function ($c) { return $c['clash_status'] == "1"; })->count();
    $ixResolved   = $clashes->filter(function ($c) { return $c['clash_status'] == "0"; })->count();
@endphp

<div class="ix-page-head">
    <div>
        <h1 class="ix-h1">Dashboard EGO</h1>
        <h2 class="ix-subtitle">View Clashes</h2>
    </div>

    <div class="ix-toolbar">
        <a class="ix-btn ix-btn-secondary" href="./exambooking">View Bookings</a>
        <div class="ix-toolbar-item">
            <a class="ix-btn ix-btn-quiet" href="" aria-disabled="true" aria-describedby="gen-note">Generate Exam timetable</a>
            <span id="gen-note" class="ix-help">Not available</span>
        </div>
    </div>
</div>

<div class="ix-board" v-pre>
    <section class="ix-lane" id="clashes" aria-labelledby="lane-unresolved">
        <header class="ix-lane-head ix-lane-head--unresolved">
            @include('partials.icon', ['name' => 'seal-clash'])
            <h3 id="lane-unresolved">Unresolved</h3>
            <span class="ix-count ix-count--unresolved ix-t">{{ $ixUnresolved }}</span>
        </header>

        <div class="clashes-container ix-lane-body">
            @foreach ($clashes as $item)
                @if ($item['clash_status'] == "1")
                    <div class="ix-clash" draggable="true" id="clash" ondragstart="drag(event)" data-status="1">
                        <div id="clash_id" class="ix-clash-id">{{ $item['id'] }}</div>
                        <div class="ix-clash-top"><span class="ix-status ix-status--unresolved">@include('partials.icon', ['name' => 'seal-clash'])Unresolved</span>@include('partials.icon', ['name' => 'grip', 'class' => 'ix-grip'])</div>
                        <p class="ix-clash-details">{{ $item['details'] }}</p>
                        <p class="ix-clash-meta">Created on: <span class="ix-t">{{ $item['clash_created'] }}</span></p>
                        <a class="ix-clash-link" href="{{ route('editclash', $item['id']) }}" draggable="false"><span>View details</span><span class="ix-vh"> for {{ \Illuminate\Support\Str::limit($item['details'], 40) }}</span>@include('partials.icon', ['name' => 'arrow-right'])</a>
                    </div>
                @endif
            @endforeach

            @if ($ixUnresolved === 0)
                <div class="ix-empty" data-celebrate="all-resolved">
                    <img class="ix-seal" src="/images/seal.svg" alt="" width="72" height="72">
                    <p class="ix-empty-title" data-perch>No unresolved clashes</p>
                </div>
                @push('living')<script src="/js/living-layer.js" defer></script><script src="/js/app-living.js" defer></script>@endpush
            @endif
        </div>
    </section>

    <section class="ix-lane" aria-labelledby="lane-resolved">
        <header class="ix-lane-head ix-lane-head--resolved">
            @include('partials.icon', ['name' => 'seal-check'])
            <h3 id="lane-resolved">Resolved</h3>
            <span class="ix-count ix-count--resolved ix-t">{{ $ixResolved }}</span>
        </header>

        <div class="clashes-container ix-lane-body" id="resolved" ondragover="allowDrop(event)" ondrop="drop(event)">
            @foreach ($clashes as $item)
                @if ($item['clash_status'] == "0")
                    <div class="ix-clash" draggable="true" id="clash" ondragstart="drag(event)" data-status="0">
                        <div id="clash_id" class="ix-clash-id">{{ $item['id'] }}</div>
                        <div class="ix-clash-top"><span class="ix-status ix-status--resolved">@include('partials.icon', ['name' => 'seal-check'])Resolved</span>@include('partials.icon', ['name' => 'grip', 'class' => 'ix-grip'])</div>
                        <p class="ix-clash-details">{{ $item['details'] }}</p>
                        <p class="ix-clash-meta">Resolved on: <span class="ix-t">{{ $item['resolved_date'] }}</span></p>
                        <a class="ix-clash-link" href="{{ route('editclash', $item['id']) }}" draggable="false"><span>View details</span><span class="ix-vh"> for {{ \Illuminate\Support\Str::limit($item['details'], 40) }}</span>@include('partials.icon', ['name' => 'arrow-right'])</a>
                    </div>
                @endif
            @endforeach

            @if ($ixResolved === 0)
                <p class="ix-lane-empty">No resolved clashes yet</p>
            @endif
        </div>
    </section>
</div>

<p class="ix-help ix-board-help">To change a status, open View details.</p>

@push('scripts')
    <script src="/js/ego_dashboard.js"></script>
    <script src="/js/board-notes.js" defer></script>
@endpush
@endsection
