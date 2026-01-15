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
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(count($cartDetails) == 0)
                    <div class="text-center" style="padding: 50px;">
                        <h3>Giỏ hàng trống!</h3>
                        <a href="{{ route('client.products') }}" class="filled-button mt-3">Mua sắm ngay</a>
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
                            @php $totalOrder = 0; @endphp 
                            @foreach($cartDetails as $item)
                                @php
                                    // Xử lý ảnh
                                    $img = $item->product->images->first()
                                            ? $item->product->images->first()->url
                                            : asset('client/assets/images/product_01.jpg');

                                    // Tính thành tiền
                                    $subtotal = $item->product->price * $item->quantity;
                                    $totalOrder += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <img src="{{ $img }}" alt="" style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    
                                    <td style="vertical-align: middle;">
                                        <h5 style="font-weight: bold;">{{ $item->product->name }}</h5>
                                    </td>
                                    
                                    <td style="vertical-align: middle;">
                                        {{ number_format($item->product->price) }} đ
                                    </td>
                                    
                                    <td style="vertical-align: middle;">
                                        <form action="{{ route('client.cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" 
                                                   class="form-control" style="width: 80px;"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    
                                    <td style="vertical-align: middle; color: red; font-weight: bold;">
                                        {{ number_format($subtotal) }} đ
                                    </td>

                                    <td style="vertical-align: middle;">
                                        <form action="{{ route('client.cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm này?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row mt-4">
                        <div class="col-md-6"></div> 
                        <div class="col-md-6" style="text-align: right;">
                            
                            <div style="margin-bottom: 20px;">
                                <span style="font-size: 18px; font-weight: bold; color: #333;">Tổng cộng: </span>
                                <span id="total-order" style="color: #f33f3f; font-size: 24px; font-weight: bold;">
                                    {{ number_format($totalOrder) }} VNĐ
                                </span>
                            </div>

                            <div style="display: flex; justify-content: flex-end; align-items: center; gap: 10px;">
                                <a href="{{ route('client.products') }}" class="btn btn-secondary" style="padding: 10px 20px;">
                                    Tiếp tục mua
                                </a>
                                
                                <a href="{{ route('client.checkout') }}" class="filled-button" style="padding: 10px 20px; border: none; text-decoration: none;">
                                    Thanh toán
                                </a>
                            </div>

                        </div>
                    </div>
                    
                @endif
            </div>
        </div>
      </div>
    </div>
@endsection