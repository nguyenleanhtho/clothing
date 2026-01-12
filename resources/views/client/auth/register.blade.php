@extends('client.layouts.master')

@section('content')
<div class="container" style="margin-top: 80px; margin-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Register</h4>
                </div>
                <div class="card-body">
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" style="font-weight: bold;">{{ __('Name') }}</label>
                            
                            <input id="name" type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required autofocus autocomplete="name">

                            @error('name')
                                <span class="text-danger mt-1" style="font-size: 14px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" style="font-weight: bold;">{{ __('Email') }}</label>
                            
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required autocomplete="username">

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
                                   required autocomplete="new-password">

                            @error('password')
                                <span class="text-danger mt-1" style="font-size: 14px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password_confirmation" style="font-weight: bold;">{{ __('Confirm Password') }}</label>
                            
                            <input id="password_confirmation" type="password" 
                                   class="form-control" 
                                   name="password_confirmation" 
                                   required autocomplete="new-password">
                            
                            @error('password_confirmation')
                                <span class="text-danger mt-1" style="font-size: 14px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-4">
                            <a class="text-muted" href="{{ route('login') }}" style="text-decoration: none; margin-right: 15px;">
                                {{ __('Already registered?') }}
                            </a>

                            <button type="submit" class="filled-button" style="border-radius: 5px; padding: 10px 25px;">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection