@extends('client.layouts.master')

@section('body_class', 'auth-page')

@section('content')
<div class="container auth-container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Log in</h4>
                </div>
                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" style="font-weight: bold;">{{ __('Email') }}</label>
                            
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required autofocus autocomplete="username">

                            @error('email')
                                <span class="text-danger mt-1" style="font-size: 14px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" style="font-weight: bold;">{{ __('Password') }}</label>

                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required autocomplete="current-password">

                            @error('password')
                                <span class="text-danger mt-1" style="font-size: 14px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                            <label class="form-check-label" for="remember_me">
                                {{ __('Remember me') }}
                            </label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            @if (Route::has('password.request'))
                                <a class="text-muted" href="{{ route('password.request') }}" style="text-decoration: none;">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <button type="submit" class="filled-button" style="border-radius: 5px; padding: 10px 25px;">
                                {{ __('Log in') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection