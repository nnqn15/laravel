@extends('layout')
@section('title', 'Yêu thích | Furnitica')
@section('content')
<div class="wrap-banner">

    <!-- breadcrumb -->
    <nav class="breadcrumb-bg">
        <div class="container no-index">
            <div class="breadcrumb">
                <ol>
                    <li>
                        <a href="{{ route('home') }}">
                            <span>Trang chủ</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.wishlist') }}">
                            <span>Yêu thích</span>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </nav>

</div>

<!-- main -->
<div id="wrapper-site">
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="m-auto col-sm-8 col-lg-9 col-md-8 product-container">
                    <h1>Yêu thích</h1>
                    <div class="js-product-list-top firt nav-top">
                        <div class="d-flex justify-content-around row">
                            <div class="col col-xs-12">
                                <ul class="nav nav-tabs">
                                    <li>
                                        <a href="#grid" data-toggle="tab" class="fa fa-th-large"></a>
                                    </li>
                                    <li>
                                        <a href="#list" data-toggle="tab" class="active show fa fa-list-ul"></a>
                                    </li>
                                </ul>
                                <div class="hidden-sm-down total-products">
                                    <p>Có 20 sản phẩm.</p>
                                </div>
                            </div>
                            <div class="col col-xs-12">
                                <div class="d-flex sort-by-row justify-content-lg-end justify-content-md-end">

                                    <div class="products-sort-order dropdown">
                                        <select class="select-title">
                                            <option value="">Lọc theo</option>
                                            <option value="">Tên, A - Z</option>
                                            <option value="">Tên, Z - A</option>
                                            <option value="">Giá, thấp - cao</option>
                                            <option value="">Giá, cao - thấp</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content product-items">
                        <div id="grid" class="related tab-pane fade in">
                            <div class="row">
                                @foreach($products as $pro)
                                <div class="item text-center col-md-4">
                                    <div class="product-miniature js-product-miniature item-one first-item">
                                        <div class="thumbnail-container border">
                                            <a href="{{url('/product-detail/'.$pro->id)}}">
                                                <img class="img-fluid image-cover" src="{{asset('img/product/'.$pro->image)}}" alt="img">
                                                <img class="img-fluid image-secondary" src="{{asset('img/product/'.$pro->image1)}}" alt="img">
                                            </a>
                                            <div class="highlighted-informations">
                                                <div class="variant-links">
                                                    <a href="#" class="color beige" title="Beige"></a>
                                                    <a href="#" class="color orange" title="Orange"></a>
                                                    <a href="#" class="color green" title="Green"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-description">
                                            <div class="product-groups">
                                                <div class="product-title">
                                                    <a href="{{url('/product-detail/'.$pro->id)}}">{{$pro->title}}</a>
                                                </div>
                                                <div class="rating">
                                                    <div class="star-content">
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                    </div>
                                                </div>
                                                <div class="product-group-price">
                                                    <div class="product-price-and-shipping">
                                                        <span class="price">{{number_format($pro->sale, 0, ',', '.')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-buttons d-flex justify-content-center">
                                                <form action="#" method="post" class="formAddToCart">
                                                    <input type="hidden" name="id_product" value="1">
                                                    <a class="add-to-cart" href="#" data-button-action="add-to-cart">
                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                    </a>
                                                </form>
                                                <a class="addToWishlist" href="#" data-rel="1" onclick="">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                </a>
                                                <a href="#" class="quick-view hidden-sm-down" data-link-action="quickview">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="list" class="related tab-pane fade active show">
                            <div class="row">
                                @foreach($products as $pro)
                                <div class="item col-md-12">
                                    <div class="product-miniature item-one first-item">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="thumbnail-container border">
                                                    <a href="{{url('/product-detail/'.$pro->id)}}">
                                                        <img class="img-fluid image-cover" src="{{asset('img/product/'.$pro->image)}}" alt="img">
                                                        <img class="img-fluid image-secondary" src="{{asset('img/product/'.$pro->image1)}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="product-description">
                                                    <div class="product-groups">
                                                        <div class="product-title">
                                                            <a href="{{url('/product-detail/'.$pro->id)}}">{{$pro->title}}</a>
                                                            <span class="info-stock">
                                                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                                Còn hàng
                                                            </span>
                                                        </div>
                                                        <div class="rating">
                                                            <div class="star-content">
                                                                <div class="star"></div>
                                                                <div class="star"></div>
                                                                <div class="star"></div>
                                                                <div class="star"></div>
                                                                <div class="star"></div>
                                                            </div>
                                                        </div>
                                                        <div class="product-group-price">
                                                            <div class="product-price-and-shipping">
                                                                <span class="price">{{number_format($pro->sale, 0, ',', '.')}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="discription">
                                                            {{$pro->description}}
                                                        </div>
                                                    </div>
                                                    <div class="product-buttons d-flex">
                                                        <form action="#" method="post" class="formAddToCart">
                                                            <a class="add-to-cart" href="{{url('/addcart/'.$pro->id)}}" data-button-action="add-to-cart">
                                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>Thêm vào giỏ hàng
                                                            </a>
                                                        </form>
                                                        <a class="addToWishlist" href="{{url('/addwish/'.$pro->id)}}" data-rel="1" onclick="">
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="{{url('/product-detail/'.$pro->id)}}" class="quick-view hidden-sm-down" data-link-action="quickview">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- pagination -->
                    <div class="pagination">
                        <div class="js-product-list-top ">
                            <div class="d-flex justify-content-around row">
                                <div class="showing col col-xs-12">
                                    <span>Hiển thị 1 - 3 trang</span>
                                </div>
                                <div class="page-list col col-xs-12">
                                    <ul>
                                        <li>
                                            <a rel="prev" href="#" class="previous disabled js-search-link">
                                                TRƯỚC
                                            </a>
                                        </li>
                                        <li class="current active">
                                            <a rel="nofollow" href="#" class="disabled js-search-link">
                                                1
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="#" class="disabled js-search-link">
                                                2
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="#" class="disabled js-search-link">
                                                3
                                            </a>
                                        </li>

                                        <li>
                                            <a rel="next" href="#" class="next disabled js-search-link">
                                                KẾ TIẾP
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection