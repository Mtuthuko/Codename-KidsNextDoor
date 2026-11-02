@extends('layouts.layout')

@section('page', 'login')

@section('content')
<section class="ix-cover ix-cover--login" aria-labelledby="login-title">
    {{-- The rosette is drawn at rest here: stillness around the form --}}
    <div class="ix-rosette-stage" aria-hidden="true">
        <div class="ix-rosette-layer" data-layer="ring"><div class="ix-rosette-z"><svg viewBox="-600 -600 1200 1200" focusable="false"></svg></div></div>
        <div class="ix-rosette-layer" data-layer="outer"><div class="ix-rosette-z"><svg viewBox="-600 -600 1200 1200" focusable="false"></svg></div></div>
        <div class="ix-rosette-layer" data-layer="inner"><div class="ix-rosette-z"><svg viewBox="-600 -600 1200 1200" focusable="false"></svg></div></div>
        <div class="ix-rosette-layer" data-layer="foil"><div class="ix-rosette-z"><svg viewBox="-600 -600 1200 1200" focusable="false"></svg></div></div>
    </div>

    <div class="ix-login-card">
        <div class="ix-card-logo">
            <img src="/images/wits-logo.png" alt="University of the Witwatersrand, Johannesburg" width="200" height="71">
        </div>

        <h1 id="login-title" class="ix-login-title" data-perch>Exam Scheduler <span class="ix-login-title-sub">– Login</span></h1>

        <form class="ix-login-form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="ix-field">
                <label class="ix-label" for="username">{{ __('Username') }}</label>
                <input id="username" type="text" class="ix-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" @error('username') aria-invalid="true" aria-describedby="username-error" @enderror>
                @error('username')
                    <p class="ix-field-error" id="username-error" role="alert">@include('partials.icon', ['name' => 'alert'])<span>{{ $message }}</span></p>
                @enderror
            </div>

            <div class="ix-field">
                <label class="ix-label" for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="ix-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                @error('password')
                    <p class="ix-field-error" id="password-error" role="alert">@include('partials.icon', ['name' => 'alert'])<span>{{ $message }}</span></p>
                @enderror
            </div>

            <div class="ix-check">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">{{ __('Remember Me') }}</label>
            </div>

            <button type="submit" class="ix-btn ix-btn-primary ix-btn-block">{{ __('Login') }}</button>
            <!--
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
          -->
        </form>
    </div>
</section>
@endsection
