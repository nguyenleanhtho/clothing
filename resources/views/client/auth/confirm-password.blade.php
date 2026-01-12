@extends('client.layouts.master')

@section('content')
<div class="container" style="margin-top: 80px; margin-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Confirm Password</h4>
                </div>
                <div class="card-body">
                    
                    <div class="alert alert-info text-muted mb-4" style="font-size: 0.9rem;">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

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

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="filled-button" style="border-radius: 5px; padding: 10px 25px;">
                                {{ __('Confirm') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection