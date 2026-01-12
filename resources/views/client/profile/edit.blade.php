@extends('client.layouts.master')

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold text-dark">{{ __('Profile') }}</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body p-4">
                        @include('client.profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body p-4">
                        @include('client.profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body p-4">
                        @include('client.profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection