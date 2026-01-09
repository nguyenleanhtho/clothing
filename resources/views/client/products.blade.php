@extends('client.layouts.master')

@section('content')

    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>New Arrivals</h4>
              <h2>Sixteen Products</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products">
      <div class="container">
        <div class="row">
          
          <div class="col-md-12">
            <div class="filters">
              <ul>
                  <li class="active" data-filter="*">All Products</li>
                  <li data-filter=".des">Featured</li>
                  <li data-filter=".dev">Flash Deals</li>
                  <li data-filter=".gra">Last Minute</li>
              </ul>
            </div>
          </div>

          <div class="col-md-12">
            <div class="filters-content">
                <div class="row grid">
                    
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-4 all des"> 
                      <div class="product-item">
                        
                        @php
                            $img = $product->images->first() ? asset($product->images->first()->img_url) : asset('client/assets/images/product_01.jpg');
                        @endphp
                        <a href="{{ route('client.product.detail', ['id' => $product->id]) }}">
                            <img src="{{ $img }}" alt="" style="height: 250px; object-fit: cover;">
                        </a>

                        <div class="down-content">
                          <a href="{{ route('client.product.detail', ['id' => $product->id]) }}">
                              <h4>{{ $product->name }}</h4>
                          </a>
                          
                          <h6>{{ number_format($product->price) }} đ</h6>
                          
                          <p>{{ Str::limit($product->description, 50) }}</p>
                          
                          <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                          </ul>
                          <span>Reviews (12)</span>
                        </div>
                      </div>
                    </div>
                    @endforeach

                </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
          </div>

        </div>
      </div>
    </div>
@endsection