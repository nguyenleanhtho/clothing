<section>
    <header>
        <h2 class="h5 font-weight-bold">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-muted small mt-2">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="form-group mb-3">
            <label for="name" class="form-label fw-bold">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $user->name) }}" 
                   required autofocus autocomplete="name">
            
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label fw-bold">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email', $user->email) }}" 
                   required autocomplete="username">
            
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-3 mb-0">
                    <p class="mb-1 text-sm">
                        {{ __('Your email address is unverified.') }}

                        {{-- Nút gửi lại email --}}
                        <button form="send-verification" class="btn btn-link p-0 align-baseline" style="font-size: inherit;">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 fw-bold text-success small mb-0">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="filled-button" style="padding: 8px 20px; border-radius: 5px;">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success ms-3 fade-out-message" style="font-size: 0.9rem;">
                    <i class="fa fa-check-circle"></i> {{ __('Saved.') }}
                </span>
                
                <script>
                    setTimeout(function() {
                        let msg = document.querySelector('.fade-out-message');
                        if(msg) {
                            msg.style.transition = "opacity 0.5s ease";
                            msg.style.opacity = 0;
                            setTimeout(() => msg.remove(), 500);
                        }
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
</section>