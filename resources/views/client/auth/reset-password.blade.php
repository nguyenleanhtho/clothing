@extends('client.layouts.master')

@section('content')
<div class="container" style="margin-top: 80px; margin-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Reset Password</h4>
                </div>
                <div class="card-body">
                    
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group mb-3">
                            <label for="email" style="font-weight: bold;">{{ __('Email') }}</label>
                            
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email', $request->email) }}" 
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

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="filled-button" style="border-radius: 5px; padding: 10px 20px;">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection