<!-- header left mobie -->
<div class="header-mobile d-md-none">
    <div class="mobile hidden-md-up text-xs-center d-flex align-items-center justify-content-around">

        <!-- menu left -->
        <div id="mobile_mainmenu" class="item-mobile-top">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>

        <!-- logo -->
        <div class="mobile-logo">
            <a href="{{ route('home') }}">
                <img class="logo-mobile img-fluid" src="{{asset('img/home/logo-mobie.png')}}" alt="Prestashop_Furnitica">
            </a>
        </div>

        <!-- menu right -->
        <div class="mobile-menutop" data-target="#mobile-pagemenu">
            <i class="zmdi zmdi-more"></i>
        </div>
    </div>

    <!-- search -->
    <div id="mobile_search" class="d-flex">
        <div id="mobile_search_content">
            <form method="get" action="#">
                <input type="text" name="s" value="" placeholder="Search">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
        <div class="desktop_cart">
            <div class="blockcart block-cart cart-preview tiva-toggle">
                <div class="header-cart tiva-toggle-btn">
                    <span class="cart-products-count">1</span>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <div class="dropdown-content">
                    <div class="cart-content">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="product-image">
                                        <a href="#">
                                            <img src="{{asset('storage/products/5.jpg')}}" alt="Product">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="product-name">
                                            <a href="#">Organic Strawberry Fruits</a>
                                        </div>
                                        <div>
                                            2 x
                                            <span class="product-price">£28.98</span>
                                        </div>
                                    </td>
                                    <td class="action">
                                        <a class="remove" href="#">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="total">
                                    <td colspan="2">Total:</td>
                                    <td>£92.96</td>
                                </tr>

                                <tr>
                                    <td colspan="3" class="d-flex justify-content-center">
                                        <div class="cart-button">
                                            <a href="product-cart.html" title="View Cart">View Cart</a>
                                            <a href="{{ route('product.checkout') }}" title="Checkout">Checkout</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- header desktop -->
<div class="header-top d-xs-none ">
    <div class="container">
        <div class="row">
            <!-- logo -->
            <div class="col-sm-2 col-md-2 d-flex align-items-center">
                <div id="logo">
                    <a href="{{ route('home') }}">
                        <img class="img-fluid" src="{{asset('img/home/logo.png')}}" alt="logo">
                    </a>
                </div>
            </div>

            <!-- menu -->
            <div class="main-menu col-sm-4 col-md-5 align-items-center justify-content-center navbar-expand-md">
                <div class="menu navbar collapse navbar-collapse">
                    <ul class="menu-top navbar-nav">
                        <li class="{{ request()->is('/') ? 'nav-link' : '' }}">
                            <a href="{{ route('home') }}" class="parent">Trang chủ</a>
                        </li>
                        <li class="{{ request()->is('shop') ? 'nav-link' : '' }}">
                            <a href="{{ route('product.shop') }}" class="parent">Cửa hàng</a>

                        </li>
                        <li class="{{ request()->is('about') ? 'nav-link' : '' }}">
                            <a href="{{ route('about') }}" class="parent">Về chúng tôi</a>
                        </li>
                        <li class="{{ request()->is('contact') ? 'nav-link' : '' }}">
                            <a href="{{ route('contact') }}" class="parent">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- search-->
            <div id="search_widget" class="col-sm-6 col-md-5 align-items-center justify-content-end d-flex">
                <form method="post" action="{{route('product.search')}}">
                @csrf
                    <input type="text" name="keyword" value="" placeholder="Tìm kiếm ..." class="ui-autocomplete-input" autocomplete="off">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>

                <!-- acount  -->
                <div id="block_myaccount_infos" class="hidden-sm-down dropdown">
                    <div class="myaccount-title">
                        <a href="#acount" data-toggle="collapse" class="acount">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Tài khoản</span>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div id="acount" class="collapse">
                        <div class="account-list-content">
                            @if (Auth::check())
                            @if (Auth::user()->role === 2)
                            <div>
                                <a class="login" href="{{ route('user.dashboard') }}" rel="nofollow" title="Log in to your customer account">
                                    <i class="fa fa-cog"></i>
                                    <span>Thông tin tài khoản</span>
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('admin.dashboard') }}" title="Go to admin">
                                    <i class="fa fa-sign-in"></i>
                                    <span>Admin</span>
                                </a>
                            </div>
                            @else
                            <div>
                                <a class="login" href="{{ route('user.dashboard') }}" rel="nofollow" title="Log in to your customer account">
                                    <i class="fa fa-cog"></i>
                                    <span>Thông tin tài khoản</span>
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('user.wishlist') }}" title="My Wishlists">
                                    <i class="fa fa-heart"></i>
                                    <span>Yêu thích</span>
                                </a>
                            </div>
                            @endif
                            @else
                            <div>
                                <a class="login" href="{{ route('user.login') }}" rel="nofollow" title="Log in to your customer account">
                                    <i class="fa fa-sign-in"></i>
                                    <span>Đăng nhập</span>
                                </a>
                            </div>
                            <div>
                                <a class="register" href="{{ route('user.register') }}" rel="nofollow" title="Register Account">
                                    <i class="fa fa-user"></i>
                                    <span>Đăng ký</span>
                                </a>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="desktop_cart">
                    <div class="blockcart block-cart cart-preview tiva-toggle">
                        <div class="header-cart tiva-toggle-btn">
                            <span class="cart-products-count">
                                @if(session('cart'))
                                {{ count(session('cart')) }}
                                @else
                                0
                                @endif
                            </span>
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </div>
                        <div class="dropdown-content">
                            <div class="cart-content">
                                <table>
                                    <tbody>
                                        <?php
                                        $total = 0;

                                        if (session('cart')) {
                                            foreach (session('cart') as $pro) {
                                                $total += $pro['sale'] * $pro['quantity'];
                                            }
                                        }
                                        ?>
                                        @if(session('cart'))
                                        @foreach(session('cart') as $pro)
                                        <tr>
                                            <td class="product-image">
                                                <a href="{{ route('product.detail', $pro['id']) }}">
                                                    <img src="{{ asset('storage/products/' . $pro['image']) }}" alt="Product">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="product-name">
                                                    <a href="{{ route('product.detail', $pro['id']) }}">{{ $pro['title'] }}</a>
                                                </div>
                                                <div>
                                                    {{ $pro['quantity'] }} x
                                                    <span class="product-price">
                                                        <strong>{{ number_format($pro['sale'], 0, ',', '.') }} VND</strong>
                                                        <del>{{ number_format($pro['price'], 0, ',', '.') }} VND</del>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="action">
                                                <a class="remove" href="#" data-id-product="{{ $pro['id'] }}">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="total">
                                            <td colspan="2">Tạm tính:</td>
                                            <td>{{ number_format($total, 0, ',', '.') }} VND</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="3">Bạn chưa thêm sản phẩm vào giỏ!</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3" class="d-flex justify-content-center">
                                                <div class="cart-button">
                                                    <a href="{{ route('product.cart') }}" title="View Cart">Giỏ hàng</a>
                                                    <a href="{{ route('product.checkout') }}" title="Checkout">Mua ngay</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>