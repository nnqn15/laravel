<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<!--<![endif]-->
<html lang="zxx">


<!-- index06:45-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="keywords" content="Furniture, thiết kế, nội thất">
    <meta name="description" content="Furnitica - Mua sắm nội thất thông minh">
    <meta name="author" content="
    ">
    <link rel="shortcut icon" href="{{ asset('img/home/icon-logo2.jpg') }}" type="image/x-icon">


    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/font-material/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/nivo-slider/css/nivo-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/nivo-slider/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/nivo-slider/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/owl-carousel/assets/owl.carousel.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reponsive.css') }}">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body id="{{ 
        Route::currentRouteNamed('home') ? 'home' : 
        (Route::currentRouteNamed('contact') ? 'contact' : 
        (Route::currentRouteNamed('about') ? 'about-us' : 
        (Route::currentRouteNamed(['product.shop', 'product.categories', 'user.wishlist','product.search']) ? 'product-sidebar-left' : 
        (Route::currentRouteNamed('product.detail') ? 'product-detail' : ''))))
    }}" class="{{ 
        Route::currentRouteNamed(['contact', 'about']) ? 'blog' : 
        (Route::currentRouteNamed(['product.shop', 'product.categories', 'user.wishlist','product.search']) ? 'product-grid-sidebar-left' : 
        (Route::currentRouteNamed('user.dashboard' ,'product.orderdetail') ? 'user-acount' : 
        (Route::currentRouteNamed('user.login','user.forgot','user.reset') ? 'user-login' : 
        (Route::currentRouteNamed('user.register','user.update') ? 'user-register blog' :
        (Route::currentRouteNamed('product.cart') ? 'product-cart checkout-cart blog' :
        (Route::currentRouteNamed('product.checkout') ? 'product-checkout checkout-cart' :  ''))))))
    }}">

    <header>
        @include('header')
    </header>
    <div class="main-content" id="{{Route::currentRouteNamed('product.cart') ? 'cart' :(Route::currentRouteNamed('product.checkout') ? 'checkout'  : '')}}">
        @yield('content')
    </div>
    <footer class="footer-one">
        @include('footer')
    </footer>
    </div>


    <!-- back top top -->
    <div class="back-to-top">
        <a href="#">
            <i class="fa fa-long-arrow-up"></i>
        </a>
    </div>

    <!-- menu mobie left -->
    @include('menumobileleft')

    <!-- menu mobie right -->
    @include('menumobileright')

    <!-- Page Loader -->
    <div id="page-preloader">
        <div class="page-loading">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
    <!-- Vendor JS -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('libs/popper/popper.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('libs/nivo-slider/js/jquery.nivo.slider.js') }}"></script>
    <script src="{{ asset('libs/owl-carousel/owl.carousel.min.js') }}"></script>

    <!-- Template JS -->
    <script src="{{ asset('js/theme.js') }}"></script>
</body>


<!-- index06:45-->

</html>