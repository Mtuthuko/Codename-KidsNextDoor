@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="flex-center position-ref full-height">
        <div class="col-md-8">
            <div class="card">
                <!--<div class="card-header">{{ __('Login') }}</div>-->
                <img  src ="https://www.wits.ac.za/media/wits-university-style-assets/images/wits-logo.png" alt="wits logo">
                <div class="title m-b-md">
                  Exam Scheduler - Login
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                      <br>
                      <div style=" padding:0 5px; top:30%; left:25%;right:25%; border-radius: 10px; align-self:center">
                        @csrf

                        <div class="form-group" style="align-self:center;display: inline-block;padding:0 2px"  >
                        <!--<div class="form-group row " style=" padding:0 5px; top:30%; left:25%;right:25%; border-radius: 10px; align-self:center">-->
                            <label for="username" class="col-md-4 col-form-label ">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <!--</div>-->

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style=" align-self:center; display: inline-block">
                                    {{ __('Login') }}
                                </button>
                                <!--
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                              -->
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div>
                      <br>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
