@extends('layouts.app')

@section('content')
<section class="ix-panel ix-panel--cert" aria-labelledby="reset-title">
    <h1 id="reset-title" class="ix-panel-title">{{ __('Reset Password') }}</h1>

    @if (session('status'))
        <div class="ix-banner ix-banner--success" role="status">
            @include('partials.icon', ['name' => 'check-circle'])
            <p>{{ session('status') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="ix-field">
            <label class="ix-label" for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="ix-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
            @error('email')
                <p class="ix-field-error" id="email-error" role="alert">@include('partials.icon', ['name' => 'alert'])<span>{{ $message }}</span></p>
            @enderror
        </div>

        <div class="ix-panel-actions">
            <button type="submit" class="ix-btn ix-btn-primary ix-btn-block">{{ __('Send Password Reset Link') }}</button>
        </div>
    </form>
</section>
@endsection
