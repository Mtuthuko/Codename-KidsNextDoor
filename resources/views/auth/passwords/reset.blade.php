@extends('layouts.app')

@section('content')
<section class="ix-panel ix-panel--cert" aria-labelledby="reset-title">
    <h1 id="reset-title" class="ix-panel-title">{{ __('Reset Password') }}</h1>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="ix-field">
            <label class="ix-label" for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="ix-input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
            @error('email')
                <p class="ix-field-error" id="email-error" role="alert">@include('partials.icon', ['name' => 'alert'])<span>{{ $message }}</span></p>
            @enderror
        </div>

        <div class="ix-field">
            <label class="ix-label" for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="ix-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
            @error('password')
                <p class="ix-field-error" id="password-error" role="alert">@include('partials.icon', ['name' => 'alert'])<span>{{ $message }}</span></p>
            @enderror
        </div>

        <div class="ix-field">
            <label class="ix-label" for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="ix-input" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="ix-panel-actions">
            <button type="submit" class="ix-btn ix-btn-primary ix-btn-block">{{ __('Reset Password') }}</button>
        </div>
    </form>
</section>
@endsection
