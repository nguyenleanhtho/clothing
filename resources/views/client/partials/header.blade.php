<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('client.index') }}" style="font-size: 24px; font-weight: bold; color: #2196F3;">
                Blue Store
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    
                    {{-- Trang chủ --}}
                    <li class="nav-item {{ Request::routeIs('client.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.index') }}">Trang chủ</a>
                    </li>
                    
                    {{-- Sản phẩm (Rút gọn từ Our Products) --}}
                    <li class="nav-item {{ Request::routeIs('client.products') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.products') }}">Sản phẩm</a>
                    </li>
                    
                    {{-- Giới thiệu --}}
                    <li class="nav-item {{ Request::routeIs('client.about') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.about') }}">Giới thiệu</a>
                    </li>

                    {{-- Liên hệ --}}
                    <li class="nav-item {{ Request::routeIs('client.contact') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.contact') }}">Liên hệ</a>
                    </li>

                    {{-- Giỏ hàng --}}
                    <li class="nav-item {{ Request::routeIs('client.cart') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.cart') }}">
                            <i class="fa fa-shopping-cart"></i> Giỏ hàng (<span id="cart-count">
                                @php
                                    $cartCount = 0;
                                    if(Auth::check()) {
                                        $cart = \App\Models\Cart::where('user_id', Auth::id())->first();
                                        if($cart) {
                                            $cartCount = \App\Models\CartDetail::where('cart_id', $cart->id)->sum('quantity');
                                        }
                                    }
                                    echo $cartCount;
                                @endphp
                            </span>)
                        </a>
                    </li>

                    {{-- Logic Đăng nhập / Đăng ký --}}
                    @guest
                        <li class="nav-item {{ Request::routeIs('login') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('register') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                        </li>
                    @else
                        {{-- Dropdown User --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                {{-- Tài khoản --}}
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Tài khoản của tôi</a>
                                </li>
                                
                                {{-- Đơn hàng (Tớ chuyển vào đây cho gọn đẹp, đúng chuẩn Shopee/Lazada) --}}
                                <li>
                                    <a class="dropdown-item" href="{{ route('client.orders.index') }}">Đơn mua</a>
                                </li>
                                
                                <li><hr class="dropdown-divider"></li>
                                
                                {{-- Đăng xuất --}}
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Đăng xuất
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>
</header>