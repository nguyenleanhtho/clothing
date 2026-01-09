@extends('client.layouts.master')

@section('content')
    <div class="page-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Join Us</h4>
              <h2>Register</h2>
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
              <h2>Đăng Ký Tài Khoản</h2>
            </div>
            <div class="contact-form">
              <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-lg-12">
                      <input name="name" type="text" class="form-control" placeholder="Họ tên" required>
                  </div>
                  <div class="col-lg-12">
                      <input name="email" type="email" class="form-control" placeholder="Email" required>
                  </div>
                  <div class="col-lg-12">
                      <input name="password" type="password" class="form-control" placeholder="Mật khẩu" required>
                  </div>
                  <div class="col-lg-12">
                      <input name="password_confirmation" type="password" class="form-control" placeholder="Nhập lại mật khẩu" required>
                  </div>
                  <div class="col-lg-12 mt-3">
                      <button type="submit" class="filled-button btn-block">Đăng Ký</button>
                  </div>
                  <div class="col-lg-12 mt-3 text-center">
                      <p>Đã có tài khoản? <a href="{{ route('login') }}" style="color:red">Đăng nhập ngay</a></p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection