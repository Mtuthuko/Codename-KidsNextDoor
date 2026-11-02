@extends('layouts.app')

@section('content')
<h1 class="ix-h1">Dashboard EGO</h1>

<section class="ix-panel ix-case" aria-labelledby="case-title">
    <h2 id="case-title" class="ix-panel-title">Clash Details</h2>

    @foreach ($clashes as $item)
    <form action="{{ route('updateclash', $item['id']) }}" method="post" class="ix-case-form">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PATCH">

        <div class="ix-case-main">
            <p class="ix-field-label">Details</p>
            <p class="ix-case-details" v-pre>{{ $item['details'] }}</p>

            <dl class="ix-case-dates">
                <dt>Date created</dt>
                <dd class="ix-t{{ ($item['clash_created'] === null || $item['clash_created'] === '') ? ' ix-empty-value' : '' }}">{{ $item['clash_created'] !== null && $item['clash_created'] !== '' ? $item['clash_created'] : '—' }}</dd>
                <dt>Date resolved</dt>
                <dd class="ix-t{{ ($item['resolved_date'] === null || $item['resolved_date'] === '') ? ' ix-empty-value' : '' }}">{{ $item['resolved_date'] !== null && $item['resolved_date'] !== '' ? $item['resolved_date'] : '—' }}</dd>
            </dl>
        </div>

        <div class="ix-case-side">
            <label class="ix-label" for="status">Change status</label>
            <select id="status" class="ix-select" name="status">
                <option value="{{ $item['clash_status'] }}">Keep current status</option>
                <option value="1">Unresolved</option>
                <option value="0">Resolved</option>
            </select>
        </div>
    @endforeach

        <div class="ix-case-status">
            <p class="ix-label">Current Status</p>
            @if ($item['clash_status'] == "0")
                <span class="ix-status ix-status--resolved">@include('partials.icon', ['name' => 'seal-check'])Resolved</span>
            @else
                <span class="ix-status ix-status--unresolved">@include('partials.icon', ['name' => 'seal-clash'])Unresolved</span>
            @endif
        </div>

        <div class="ix-case-actions">
            <button type="submit" class="ix-btn ix-btn-primary">Update</button>
            <a class="ix-btn ix-btn-secondary" href="/home">Back</a>
        </div>
    </form>
</section>
@endsection
