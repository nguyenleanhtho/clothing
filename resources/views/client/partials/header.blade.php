<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('client.index') }}">
                <h2>Sixteen <em>Clothing</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    
                    <li class="nav-item {{ Request::routeIs('client.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.index') }}">Home</a>
                    </li>
                    
                    <li class="nav-item {{ Request::routeIs('client.products') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.products') }}">Our Products</a>
                    </li>
                    
                    <li class="nav-item {{ Request::routeIs('client.about') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.about') }}">About Us</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('client.contact') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.contact') }}">Contact Us</a>
                    </li>

                    <li class="nav-item {{ Request::routeIs('client.cart') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.cart') }}">
                            <i class="fa fa-shopping-cart"></i> Cart (0)
                        </a>
                    </li>

                    @guest
    <li class="nav-item {{ Request::routeIs('login') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>
    <li class="nav-item {{ Request::routeIs('register') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('register') }}">Register</a>
    </li>
@else
    @endguest

                </ul>
            </div>
        </div>
    </nav>
</header>