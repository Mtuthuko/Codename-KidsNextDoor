@extends('layouts.app')

@section('content')
<section class="ix-panel ix-panel--cert" aria-labelledby="register-title">
    <h1 id="register-title" class="ix-panel-title">{{ __('Register') }}</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="ix-field">
            <label class="ix-label" for="name">{{ __('Name') }}</label>
            <input id="name" type="text" class="ix-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
            @error('name')
                <p class="ix-field-error" id="name-error" role="alert">@include('partials.icon', ['name' => 'alert'])<span>{{ $message }}</span></p>
            @enderror
        </div>

        <div class="ix-field">
            <label class="ix-label" for="username">{{ __('Username') }}</label>
            <input id="username" type="text" class="ix-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" @error('username') aria-invalid="true" aria-describedby="username-error" @enderror>
            @error('username')
                <p class="ix-field-error" id="username-error" role="alert">@include('partials.icon', ['name' => 'alert'])<span>{{ $message }}</span></p>
            @enderror
        </div>

        <div class="ix-field">
            <label class="ix-label" for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="ix-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
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
            <button type="submit" class="ix-btn ix-btn-primary ix-btn-block">{{ __('Register') }}</button>
        </div>
    </form>
</section>
@endsection
