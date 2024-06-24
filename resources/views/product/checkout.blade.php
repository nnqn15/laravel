@extends('layout')
@section('title', 'Thanh toán | Furnitica')
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
                        <a href="{{ route('product.cart') }}">
                            <span>Giỏ hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product.checkout') }}">
                            <span>Thanh toán</span>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </nav>

    <!-- main -->
    <div id="wrapper-site">
        <div class="container">
            <div class="row">
                <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">
                    <div id="main">
                        @if($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li style="color:red">{{$error}}</li>
                            @endforeach
                        </ul>
                        @endif
                        <div class="cart-grid row">
                            <div class="col-md-9 check-info">
                                <form action="{{route('product.order')}}" id="customer-form" class="js-customer-form" method="post">
                                    <div class="checkout-personal-step">
                                        <h3 class="step-title h3 info">
                                            <span class="step-number">1</span>Thông tin giao hàng
                                        </h3>
                                    </div>
                                    <div class="content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active show" id="checkout-guest-form" role="tabpanel">
                                                <div>
                                                <div class="form-group row">
                                                        @if(Auth::check())
                                                        <input class="form-control" name="name" type="text" placeholder="Họ và tên" value='{{old('name',Auth::user()->name)}}'>
                                                        @else
                                                        <input class="form-control" name="name" type="text" placeholder="Họ và tên" value='{{old('name')}}'>
                                                        @endif
                                                        @error('name')
                                                        <span class="text-danger text-start">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row">
                                                        @if(Auth::check())
                                                        <input class="form-control" name="email" type="email" placeholder="Email" value='{{old('email',Auth::user()->email)}}'>
                                                        @else
                                                        <input class="form-control" name="email" type="email" placeholder="Email" value='{{old('email')}}'>
                                                        @endif
                                                        @error('email')
                                                        <span class="text-danger text-start">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row">
                                                        <input class="form-control" name="phone" type="number" placeholder="Số điện thoại" value='{{old('phone')}}'>
                                                        @error('phone')
                                                        <span class="text-danger text-start">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row">
                                                        <input class="form-control" name="address" type="text" placeholder="Địa chỉ" value='{{old('address')}}'>
                                                        @error('address')
                                                        <span class="text-danger text-start">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="checkout-personal-step">
                                        <h3 class="step-title h3">
                                            <span class="step-number">2</span>Sản phẩm
                                        </h3>
                                    </div>
                                    <div class="content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade in" id="checkout-guest-form" role="tabpanel">
                                                <ul>
                                                    @foreach($cart as $pro)
                                                    <li class="d-flex align-items-center mt-3" style="gap: 20px;">
                                                        <div class="name w-50">{{ $pro['title'] }}</div>
                                                        <div class="price text-center w-25"><strong>{{ number_format($pro['sale'], 0, ',', '.') }} VND</strong><br><del>{{ number_format($pro['price'], 0, ',', '.') }} VND</del></div>
                                                        <div class="quantity text-center w-25">X {{ $pro['quantity'] }}</div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="checkout-personal-step">
                                        <h3 class="step-title h3">
                                            <span class="step-number">3</span>Phương thức thanh toán
                                        </h3>
                                    </div>
                                    <div class="content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade in" id="checkout-guest-form" role="tabpanel">
                                                <input type="radio" id="payment_method_1" name="payment_method" checked value="1">
                                                <label for="payment_method_1">Thanh toán khi nhận hàng</label><br>

                                                <input type="radio" id="payment_method_2" name="payment_method" value="2">
                                                <label for="payment_method_2">Chuyển khoản</label><br>

                                                <input type="radio" id="payment_method_3" name="payment_method" value="3">
                                                <label for="payment_method_3">Thanh toán bằng QR</label><br>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button class="continue btn btn-primary pull-xs-right" name="submitcheckout" value="1" type="submit">
                                                    Tiếp tục
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy tất cả các phần tử h3
        var steps = document.querySelectorAll('.step-title');

        // Lấy tất cả các tab-pane
        var tabContents = document.querySelectorAll('.tab-pane');

        // Xử lý sự kiện click cho mỗi phần tử h3
        steps.forEach(function(step, index) {
            step.addEventListener('click', function() {
                // Ẩn tất cả các tab-pane
                tabContents.forEach(function(tabContent) {
                    tabContent.classList.remove('active', 'show');
                });

                // Hiển thị tab-pane tương ứng với phần tử h3 được nhấp vào
                tabContents[index].classList.add('active', 'show');

                // Loại bỏ class "info" từ tất cả các phần tử h3
                steps.forEach(function(step) {
                    step.classList.remove('info');
                });

                // Thêm class "info" vào phần tử h3 được nhấp vào
                step.classList.add('info');
            });
        });
    });
</script>

@endsection