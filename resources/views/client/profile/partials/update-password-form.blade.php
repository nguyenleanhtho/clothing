<section>
    <header>
        <h2 class="h5 font-weight-bold">
            {{ __('Update Password') }}
        </h2>

        <p class="text-muted small mt-2">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="form-group mb-3">
            <label for="update_password_current_password" class="form-label fw-bold">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" 
                   name="current_password" 
                   type="password" 
                   class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif" 
                   autocomplete="current-password">
            
            {{-- Hiển thị lỗi (Lưu ý: Breeze dùng error bag tên là 'updatePassword' cho form này) --}}
            @if($errors->updatePassword->has('current_password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="update_password_password" class="form-label fw-bold">{{ __('New Password') }}</label>
            <input id="update_password_password" 
                   name="password" 
                   type="password" 
                   class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif" 
                   autocomplete="new-password">

            @if($errors->updatePassword->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password') }}
                </div>
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="update_password_password_confirmation" class="form-label fw-bold">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" 
                   name="password_confirmation" 
                   type="password" 
                   class="form-control @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif" 
                   autocomplete="new-password">

            @if($errors->updatePassword->has('password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            {{-- Dùng class filled-button theo giao diện của cậu, hoặc btn btn-primary --}}
            <button type="submit" class="filled-button" style="padding: 8px 20px; border-radius: 5px;">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <span class="text-success ms-3 fade-out-message" style="font-size: 0.9rem;">
                    <i class="fa fa-check-circle"></i> {{ __('Saved.') }}
                </span>
                
                {{-- Script nhỏ để ẩn thông báo sau 2 giây (thay thế cho Alpine x-transition) --}}
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