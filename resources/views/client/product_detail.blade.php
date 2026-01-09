@extends('client.layouts.master')

@section('content')

    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>New Arrivals</h4>
              <h2>Product Details</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products">
      <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-4">
                <div style="text-align: center; background-color: #f9f9f9; padding: 20px; border-radius: 10px;">
                    @php
                        $mainImage = $product->images->first() ? asset($product->images->first()->img_url) : asset('client/assets/images/product_01.jpg');
                    @endphp
                    
                    <img src="{{ $mainImage }}" class="img-fluid" 
                         style="max-height: 400px; width: auto; max-width: 100%; object-fit: contain;">
                </div>
            </div>

            <div class="col-md-8">
                <div class="right-content" style="padding-left: 30px;">
                    
                    <h4 style="margin-top: 0;">{{ $product->name }}</h4>
                    
                    <h6 class="text-danger" style="font-size: 20px; margin: 15px 0;">{{ number_format($product->price) }} VNĐ</h6>
                    
                    <p style="color: #666; line-height: 1.8;">{{ $product->description }}</p>

                    <form action="{{ route('client.cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="form-group" style="margin-top: 30px;">
                            <div class="d-flex align-items-end">
                                
                                <div style="width: 100px; margin-right: 20px;">
                                    <label style="font-weight: bold; margin-bottom: 5px;">Số lượng:</label>
                                    <input type="number" name="quantity" value="1" min="1" class="form-control" style="border-radius: 5px;">
                                </div>

                                <button type="submit" class="filled-button" style="padding: 8px 20px; border-radius: 5px; height: 38px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-shopping-cart" style="margin-right: 8px;"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
      </div>
    </div>

    <div class="latest-products">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>

            @foreach($relatedProducts as $item)
            <div class="col-md-4">
                <div class="product-item">
                    @php
                        $img = $item->images->first() ? asset($item->images->first()->img_url) : asset('client/assets/images/product_02.jpg');
                    @endphp
                    <a href="{{ route('client.product.detail', $item->id) }}">
                        <img src="{{ $img }}" alt="" style="width: 100%; height: 280px; object-fit: cover;">
                    </a>
                    
                    <div class="down-content">
                        <a href="{{ route('client.product.detail', $item->id) }}"><h4>{{ $item->name }}</h4></a>
                        <h6>{{ number_format($item->price) }} VNĐ</h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
      </div>
    </div>
@endsection