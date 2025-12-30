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
        <div class="row">
            
            <div class="col-md-6">
                <img src="{{ asset('client/assets/images/product_01.jpg') }}" alt="" class="img-fluid" style="width: 100%; object-fit: cover;">
            </div>

            <div class="col-md-6">
                <div class="right-content" style="padding-left: 30px;">
                    <h4 style="font-size: 28px; margin-bottom: 15px;">Tittle goes here</h4>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 style="font-size: 22px; color: #f33f3f;">$25.75</h6>
                        <ul class="stars" style="list-style: none; padding: 0; display: flex;">
                            <li><i class="fa fa-star" style="color: #f33f3f; font-size: 14px;"></i></li>
                            <li><i class="fa fa-star" style="color: #f33f3f; font-size: 14px;"></i></li>
                            <li><i class="fa fa-star" style="color: #f33f3f; font-size: 14px;"></i></li>
                            <li><i class="fa fa-star" style="color: #f33f3f; font-size: 14px;"></i></li>
                            <li><i class="fa fa-star" style="color: #aaa; font-size: 14px;"></i></li>
                        </ul>
                    </div>

                    <p style="margin-bottom: 30px; line-height: 25px; color: #4a4a4a;">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>

                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="quantity" style="font-weight: 500;">Quantity:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" style="width: 80px; margin-bottom: 20px;">
                            </div>
                            <div class="col-md-8" style="display: flex; align-items: flex-end;">
                                <button type="submit" class="filled-button" style="width: 100%; border: none; padding: 10px 20px;">Add to Cart</button>
                            </div>
                        </div>
                    </form>

                    <hr style="margin: 30px 0;">

                    <div class="down-content">
                        <div class="categories">
                            <h6 style="font-size: 15px;">Category: <span><a href="#">Fashion</a>, <a href="#">Clothing</a></span></h6>
                        </div>
                        <div class="share">
                            <h6 style="font-size: 15px; margin-top: 10px;">Share: 
                                <span>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </span>
                            </h6>
                        </div>
                    </div>
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
              <h2>Related Products</h2>
              <a href="{{ route('client.products') }}">view all products <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="{{ asset('client/assets/images/product_02.jpg') }}" alt=""></a>
              <div class="down-content">
                <a href="#"><h4>Tittle goes here</h4></a>
                <h6>$30.25</h6>
                <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (21)</span>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="{{ asset('client/assets/images/product_03.jpg') }}" alt=""></a>
              <div class="down-content">
                <a href="#"><h4>Tittle goes here</h4></a>
                <h6>$20.45</h6>
                <p>Sixteen Clothing is free CSS template provided by TemplateMo.</p>
                <ul class="stars">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                  </ul>
                <span>Reviews (36)</span>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="{{ asset('client/assets/images/product_04.jpg') }}" alt=""></a>
              <div class="down-content">
                <a href="#"><h4>Tittle goes here</h4></a>
                <h6>$15.25</h6>
                <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                <ul class="stars">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                  </ul>
                <span>Reviews (48)</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
@endsection