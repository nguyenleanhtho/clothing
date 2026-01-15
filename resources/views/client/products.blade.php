@extends('client.layouts.master')

@section('content')

    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>New Arrivals</h4>
              <h2>BlueStore Products</h2>
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
                          $img = $product->images->first() ? $product->images->first()->url : asset('client/assets/images/product_01.jpg');
                        @endphp
                        
                        <div style="position: relative; width: 100%; height: 250px; overflow: hidden;">
                          <a href="{{ route('client.product.detail', ['id' => $product->id]) }}" style="display: block; width: 100%; height: 100%;">
                              <img src="{{ $img }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
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
                          <a href="{{ route('client.product.detail', ['id' => $product->id]) }}">
                              <h4>{{ Str::limit($product->name, 20) }}</h4>
                          </a>
                          
                          <h6>{{ number_format($product->price) }} đ</h6>
                          
                          <p>{{ Str::limit($product->description, 50) }}</p>
                          
                          <div style="margin-top: 10px;">
                            @if($product->stock > 0)
                              <button class="btn btn-primary btn-sm add-to-cart-btn" data-product-id="{{ $product->id }}" style="margin-right: 5px;">
                                <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                              </button>
                              <button class="btn btn-success btn-sm buy-now-btn" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" data-product-stock="{{ $product->stock }}">
                                <i class="fa fa-bolt"></i> Mua ngay
                              </button>
                            @else
                              <button class="btn btn-secondary btn-sm" disabled>
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
          <div class="col-md-12">
            <div class="d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-4') }}
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