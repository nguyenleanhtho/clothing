@extends('client.layouts.master')

@section('content')

    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <h4>Best Offer</h4>
            <h2>New Arrivals On Sale</h2>
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <h4>Flash Deals</h4>
            <h2>Get your best products</h2>
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <h4>Last Minute</h4>
            <h2>Grab last minute deals</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
              <a href="{{ url('/products') }}">view all products <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
          
          @foreach($products as $product)
          <div class="col-md-4 mb-4">
            <div class="product-item">
              <div style="position: relative; width: 100%; height: 300px; overflow: hidden;">
                <a href="{{ route('client.product.detail', $product->id) }}" style="display: block; width: 100%; height: 100%;">
                  <img src="{{ $product->firstImage() ? $product->firstImage()->url : asset('client/assets/images/product_01.jpg') }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                </a>
                
                <!-- Status Badge at bottom-right corner -->
                <div style="position: absolute; bottom: 10px; right: 10px; z-index: 10;">
                  @if($product->stock <= 0)
                    <span style="display: inline-block; background-color: #dc3545; color: white; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                      <i class="fa fa-times-circle"></i> Hết hàng
                    </span>
                  @elseif($product->stock <= 10)
                    <span style="display: inline-block; background-color: #ff6b6b; color: white; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                      <i class="fa fa-exclamation-triangle"></i> Chỉ còn {{ $product->stock }} cái
                    </span>
                  @else
                    <span style="display: inline-block; background-color: #28a745; color: white; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                      <i class="fa fa-check-circle"></i> Còn hàng
                    </span>
                  @endif
                </div>
              </div>
              <div class="down-content">
                <a href="{{ route('client.product.detail', $product->id) }}"><h4>{{ $product->name }}</h4></a>
                <h6 style="color: #f33f3f; font-weight: bold; margin: 8px 0;">{{ number_format($product->price) }} đ</h6>
                <p style="font-size: 13px; color: #666; margin: 8px 0;">{{ Str::limit($product->description, 80) }}</p>
                
                <div style="margin-top: 12px;">
                  @if($product->stock > 0)
                    <button class="btn btn-primary btn-sm add-to-cart-btn" data-product-id="{{ $product->id }}" style="margin-right: 5px; font-size: 12px; padding: 6px 10px;">
                      <i class="fa fa-shopping-cart"></i> Giỏ hàng
                    </button>
                    <button class="btn btn-success btn-sm buy-now-btn" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" data-product-stock="{{ $product->stock }}" style="font-size: 12px; padding: 6px 10px;">
                      <i class="fa fa-bolt"></i> Mua ngay
                    </button>
                  @else
                    <button class="btn btn-secondary btn-sm" disabled style="font-size: 12px; padding: 6px 10px;">
                      <i class="fa fa-ban"></i> Hết hàng
                    </button>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @endforeach
          
          </div>
      </div>
    </div>

    <div class="best-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>About BlueStore Clothing</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4>Looking for the best products?</h4>
              <p><a rel="nofollow" href="https://templatemo.com/tm-546-sixteen-clothing" target="_parent">This template</a> is free to use for your business websites. However, you have no permission to redistribute the downloadable ZIP file on any template collection website. <a rel="nofollow" href="https://templatemo.com/contact">Contact us</a> for more info.</p>
              <ul class="featured-list">
                <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                <li><a href="#">Consectetur an adipisicing elit</a></li>
                <li><a href="#">It aquecorporis nulla aspernatur</a></li>
                <li><a href="#">Corporis, omnis doloremque</a></li>
                <li><a href="#">Non cum id reprehenderit</a></li>
              </ul>
              <a href="{{ url('/about') }}" class="filled-button">Read More</a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="{{ asset('client/assets/images/feature-image.jpg') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <div class="row">
                <div class="col-md-8">
                  <h4>Creative &amp; Unique <em>BlueStore</em> Products</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque corporis amet elite author nulla.</p>
                </div>
                <div class="col-md-4">
                  <a href="#" class="filled-button">Purchase Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Modal Mua Ngay -->
<div class="modal fade" id="buyNowModal" tabindex="-1" role="dialog" aria-labelledby="buyNowModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buyNowModalLabel">Chọn số lượng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="buyNowForm" action="{{ route('client.cart.add') }}" method="POST">
          @csrf
          <input type="hidden" name="product_id" id="modal-product-id">
          <input type="hidden" name="redirect_to_checkout" value="1">
          
          <div class="form-group">
            <label>Sản phẩm: <strong id="modal-product-name"></strong></label>
          </div>
          <div class="form-group">
            <label>Giá: <strong id="modal-product-price"></strong></label>
          </div>
          <div class="form-group">
            <label for="modal-quantity">Số lượng:</label>
            <input type="number" class="form-control" id="modal-quantity" name="quantity" value="1" min="1" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-success" id="confirmBuyNow">Mua ngay</button>
      </div>
    </div>
  </div>
</div>

<script>
// Thêm giỏ hàng bằng AJAX
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý nút "Thêm giỏ hàng"
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest
            
            // Gửi AJAX để thêm vào giỏ
            fetch('{{ route("client.cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if(data.success) {
                    // Cập nhật số lượng giỏ hàng
                    document.getElementById('cart-count').textContent = data.cart_count;
                    alert('Đã thêm sản phẩm vào giỏ hàng!');
                } else {
                    alert(data.message || 'Có lỗi xảy ra!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra! ' + error.message);
            });
        });
    });
    
    // Xử lý nút "Mua ngay"
    document.querySelectorAll('.buy-now-btn').forEach(button => {
        button.addEventListener('click', function() {
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest
            
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productPrice = this.getAttribute('data-product-price');
            
            // Hiển thị modal
            document.getElementById('modal-product-id').value = productId;
            document.getElementById('modal-product-name').textContent = productName;
            document.getElementById('modal-product-price').textContent = '$' + parseFloat(productPrice).toFixed(2);
            
            $('#buyNowModal').modal('show');
        });
    });
    
    // Xử lý xác nhận mua ngay
    document.getElementById('confirmBuyNow').addEventListener('click', function() {
        document.getElementById('buyNowForm').submit();
    });
});
</script>

@endsection