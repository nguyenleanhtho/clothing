@extends('client.layouts.master')

@section('content')

    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Your Shopping Cart</h4>
              <h2>Check your items</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                @if(count($cartDetails) == 0)
                    <div class="text-center" style="padding: 50px;">
                        <h3>Giỏ hàng của bạn đang trống! 😢</h3>
                        <a href="{{ url('/') }}" class="filled-button mt-3">Mua sắm ngay</a>
                    </div>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr style="background-color: #f7f7f7;">
                                <th style="width: 15%">Ảnh</th>
                                <th style="width: 30%">Sản phẩm</th>
                                <th style="width: 15%">Giá</th>
                                <th style="width: 15%">Số lượng</th>
                                <th style="width: 20%">Thành tiền</th>
                                <th style="width: 5%">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalOrder = 0; @endphp @foreach($cartDetails as $item)
                                @php
                                    // 1. Xử lý ảnh (Logic cũ cậu đã quen)
                                    $img = $item->product->images->first() 
                                            ? asset($item->product->images->first()->img_url) 
                                            : asset('client/assets/images/product_01.jpg');
                                    
                                    // 2. Tính thành tiền của từng món (Giá x Số lượng)
                                    $subtotal = $item->product->price * $item->quantity;
                                    
                                    // 3. Cộng dồn vào tổng đơn hàng
                                    $totalOrder += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <img src="{{ $img }}" alt="" style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    
                                    <td style="vertical-align: middle;">
                                        <h5>{{ $item->product->name }}</h5>
                                    </td>
                                    
                                    <td style="vertical-align: middle;">
                                        {{ number_format($item->product->price) }} đ
                                    </td>
                                    
                                    <td style="vertical-align: middle;">
                                        <input type="number" value="{{ $item->quantity }}" class="form-control" style="width: 70px" readonly>
                                    </td>
                                    
                                    <td style="vertical-align: middle; color: red; font-weight: bold;">
                                        {{ number_format($subtotal) }} đ
                                    </td>

                                    <td style="vertical-align: middle;">
                                        <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row mt-4">
                        <div class="col-md-6"></div> <div class="col-md-6 text-right">
                            <h4>Tổng cộng: <span style="color: #f33f3f">{{ number_format($totalOrder) }} VNĐ</span></h4>
                            <div class="mt-3">
                                <a href="{{ url('/') }}" class="btn btn-secondary">Tiếp tục mua hàng</a>
                                <a href="#" class="filled-button">Thanh toán (Checkout)</a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
      </div>
    </div>
@endsection