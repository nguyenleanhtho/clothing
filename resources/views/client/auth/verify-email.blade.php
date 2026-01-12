@extends('client.layouts.master')

@section('content')
<div class="container" style="margin-top: 80px; margin-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Verify Email Address</h4>
                </div>
                <div class="card-body">
                    
                    <div class="mb-4 text-muted" style="font-size: 0.9rem;">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success mb-4" role="alert">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <button type="submit" class="filled-button" style="border-radius: 5px; padding: 10px 20px;">
                                {{ __('Resend Verification Email') }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout