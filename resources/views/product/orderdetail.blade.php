@extends('layout')
@section('title', 'Chi tiết đơn hàng | Furnitica')
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
                        <a href="{{ route('product.orderdetail',$id) }}">
                            <span>Chi tiết đơn hàng</span>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </nav>

    <div class="acount head-acount">
        <div class="container">
            <div id="main">
                <div class="order">
                    <h2>Chi tiết đơn hàng
                    </h2>
                    <div class="d-flex align-items-center mt-3">
                        <div class="text-center" style="width: 150px;">Ảnh</div>
                        <div class="text-center" style="flex:1;">Tên sản phẩm</div>
                        <div class="text-center" style="width: 100px;">Số lượng</div>
                        <div class="text-center">
                            Giá sản phẩm
                        </div>
                    </div>
                    @foreach($orderDetails as $order)
                    <div class="d-flex align-items-center mt-3">
                        <img src="{{ asset('storage/products/' . $order->product->image) }}" width="150px" alt="Product Image">
                        <div style="flex:1;">{{$order->product->title}}</div>
                        <div class="text-center" style="width: 100px;">{{ $order->quantity }}</div>
                        <div class="text-center" class="w-25">
                            {{number_format($order->price, 0, ',', '.')}} VND
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</div>
@endsection