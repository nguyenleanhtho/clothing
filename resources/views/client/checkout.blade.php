@extends('client.layouts.master')

@section('content')
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-content">
          <h4>Thanh toán</h4>
          <h2>Hoàn tất đơn hàng</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container" style="margin-top: 50px; margin-bottom: 80px;">
    <form action="{{ route('client.checkout.process') }}" method="POST">
        @csrf
        <div class="row">
            
            <div class="col-md-7">
                <h4 class="mb-4">Thông tin giao hàng</h4>
                
                <div class="form-group mb-3">
                    <label>Họ và tên người nhận (*)</label>
                    <input type="text" name="name" class="form-control" 
                           value="{{ Auth::user()->name }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Số điện thoại (*)</label>
                    <input type="text" name="phone" class="form-control" 
                           value="{{ Auth::user()->phone ?? '' }}" 
                           placeholder="Nhập số điện thoại liên hệ" required>
                </div>

                <div class="form-group mb-3">
                    <label>Địa chỉ nhận hàng (*)</label>
                    <textarea name="address" class="form-control" rows="3" 
                              placeholder="Số nhà, tên đường, phường/xã..." required>{{ Auth::user()->address ?? '' }}</textarea>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm border-0" style="background-color: #f9f9f9;">
                    <div class="card-body">
                        <h4 class="mb-4">Đơn hàng của bạn</h4>
                        <ul class="list-group list-group-flush" style="background: transparent;">
                            @php $total = 0; @endphp
                            @foreach($cartDetails as $item)
                                @php 
                                    $subtotal = $item->product->price * $item->quantity; 
                                    $total += $subtotal; 
                                @endphp
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="background: transparent; padding-left:0; padding-right:0;">
                                    <div>
                                        <strong>{{ $item->product->name }}</strong>
                                        <div class="text-muted small">x {{ $item->quantity }}</div>
                                    </div>
                                    <span>{{ number_format($subtotal) }} đ</span>
                                </li>
                            @endforeach
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center border-top mt-3 pt-3" style="background: transparent; padding-left:0; padding-right:0;">
                                <strong style="font-size: 1.2rem;">Tổng cộng</strong>
                                <strong style="color: #f33f3f; font-size: 1.3rem;">{{ number_format($total) }} đ</strong>
                            </li>
                        </ul>

                        <hr>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" checked>
                            <label class="form-check-label">
                                Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                        
                        <button type="submit" class="filled-button btn-block w-100 py-2">
                            XÁC NHẬN ĐẶT HÀNG
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection