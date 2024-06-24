@extends('layout')
@section('title', 'Giỏ hàng | Furnitica')
@section('content')
<div id="wrapper-site">
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
                        <a href="{{ route('product.cart') }}">
                            <span>Giỏ hàng</span>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">
                <section id="main">
                    <div class="cart-grid row">
                        <div class="col-md-9 col-xs-12 check-info">
                            <h1 class="title-page">GIỎ HÀNG</h1>
                            <div class="cart-container">
                                <div class="cart-overview js-cart">
                                    @if($cart)
                                    <ul class="cart-items">
                                        @foreach($cart as $pro)
                                        <li class="cart-item" data-id="{{ $pro['id'] }}">
                                            <div class="product-line-grid row justify-content-between">
                                                <div class="product-line-grid-left col-md-2">
                                                    <span class="product-image media-middle">
                                                        <a href="{{ route('product.detail', $pro['id']) }}">
                                                            <img class="img-fluid" src="{{ asset('storage/products/' . $pro['image']) }}" alt="{{ $pro['title'] }}">
                                                        </a>
                                                    </span>
                                                </div>
                                                <div class="product-line-grid-body col-md-6">
                                                    <div class="product-line-info">
                                                        <a class="label" href="{{ route('product.detail', $pro['id']) }}" data-id_customization="0">{{ $pro['title'] }}</a>
                                                    </div>
                                                    <div class="product-line-info product-price">
                                                        <span class="value"><strong class="text-danger">{{ number_format($pro['sale'], 0, ',', '.') }} VND</strong> <del>{{ number_format($pro['price'], 0, ',', '.') }} VND</del></span>
                                                    </div>
                                                </div>
                                                <div class="product-line-grid-right text-center product-line-actions col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-5 col qty">
                                                            <div class="label">Số lượng:</div>
                                                            <div class="quantity">
                                                                <input type="text" class="quantity-input input-group form-control" value="{{ $pro['quantity'] }}">
                                                                <span class="input-group-btn-vertical">
                                                                    <button class="btn btn-touchspin js-cart-touchspin cart-touchspin-up" type="button">+</button>
                                                                    <button class="btn btn-touchspin js-cart-touchspin cart-touchspin-down" type="button">-</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5 col price">
                                                            <div class="label">Tổng:</div>
                                                            <div class="product-price total">
                                                                {{ number_format($pro['quantity'] * $pro['sale'], 0, ',', '.') }} VND
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col text-xs-right align-self-end">
                                                            <div class="cart-line-product-actions">
                                                                <a class="remove-from-cart" rel="nofollow" href="#" data-link-action="delete-from-cart" data-id-product="{{ $pro['id'] }}">
                                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <h3 class="mb-3">Bạn không có sản phẩm trong giỏ hàng!</h3>
                                    @endif
                                </div>
                            </div>
                            <a href="{{route('product.checkout')}}" class="continue btn btn-primary pull-xs-right">
                                Mua hàng
                            </a>
                        </div>
                        <div class="cart-grid-right col-xs-12 col-lg-3">
                            <div class="cart-summary">
                                <div class="cart-detailed-totals">
                                    <div class="cart-summary-products">
                                        <div class="summary-label">Bạn có {{ count($cart) }} sản phẩm trong giỏ hàng</div>
                                    </div>
                                    <div class="cart-summary-line" id="cart-subtotal-products">
                                        <span class="label js-subtotal">
                                            Tạm tính:
                                        </span>
                                        <span class="value subtotal">{{ number_format($subtotal, 0, ',', '.') }} VND</span>
                                    </div>
                                    <div class="cart-summary-line" id="cart-subtotal-shipping">
                                        <span class="label">
                                            Phí giao hàng:
                                        </span>
                                        <span class="value">Miễn phí</span>
                                        <div>
                                            <small class="value"></small>
                                        </div>
                                    </div>
                                    <div class="cart-summary-line cart-total">
                                        <span class="label">Tổng tiền:</span>
                                        <span class="value total">{{ number_format($total, 0, ',', '.') }} VND</span>
                                    </div>
                                </div>
                            </div>
                            <div id="block-reassurance">
                                <ul>
                                    <li>
                                        <div class="block-reassurance-item">
                                            <img src="storage/products/check1.png" alt="Security policy (edit with Customer reassurance module)">
                                            <span>Bảo mật thông tin</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="block-reassurance-item">
                                            <img src="storage/products/check2.png" alt="Delivery policy (edit with Customer reassurance module)">
                                            <span>Giao hàng miễn phí</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="block-reassurance-item">
                                            <img src="storage/products/check3.png" alt="Return policy (edit with Customer reassurance module)">
                                            <span>Miễn phí đổi trả</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection