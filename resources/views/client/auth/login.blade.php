@extends('client.layouts.master')

@section('content')
    <div class="page-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Welcome Back</h4>
              <h2>Login</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="send-message">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="section-heading">
              <h2>Đăng Nhập</h2>
            </div>
            <div class="contact-form">
              <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-lg-12">
                    <fieldset>
                      <input name="email" type="email" class="form-control" placeholder="Email" required>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <input name="password" type="password" class="form-control" placeholder="Mật khẩu" required>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" class="filled-button btn-block">Đăng Nhập</button>
                    </fieldset>
                  </div>
                  <div class="col-lg-12 mt-3 text-center">
                      <p>Chưa có tài khoản? <a href="{{ route('register') }}" style="color:red">Đăng ký ngay</a></p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection