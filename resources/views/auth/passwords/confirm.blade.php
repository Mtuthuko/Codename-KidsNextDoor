@extends('layouts.app')

@section('content')
<section class="ix-panel ix-panel--cert" aria-labelledby="confirm-title">
    <h1 id="confirm-title" class="ix-panel-title">{{ __('Confirm Password') }}</h1>
    <p class="ix-lede">{{ __('Please confirm your password before continuing.') }}</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="ix-field">
            <label class="ix-label" for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="ix-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
            @error('password')
                <p class="ix-field-error" id="password-error" role="alert">@include('partials.icon', ['name' => 'alert'])<span>{{ $message }}</span></p>
            @enderror
        </div>

        <div class="ix-panel-actions">
            <button type="submit" class="ix-btn ix-btn-primary ix-btn-block">{{ __('Confirm Password') }}</button>

            @if (Route::has('password.request'))
                <a class="ix-panel-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            @endif
        </div>
    </form>
</section>
@endsection
