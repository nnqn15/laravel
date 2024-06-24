<?php

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

$orders = Order::Where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->get();
?>
@extends('layout')
@section('title', 'Tài khoản | Furnitica')
@section('content')
@auth
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
                        <a href="{{ route('user.dashboard') }}">
                            <span>Tài khoản</span>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </nav>

    <div class="acount head-acount">
        <div class="container">
            <div id="main">
                @if(Auth()->user())
                <h1 class="title-page">Thông tin tài khoản</h1>
                <div class="content" id="block-history">
                    <table class="std table">
                        <tbody>
                            <tr>
                                <th class="first_item">Tên :</th>
                                <td>{{Auth()->user()->name}}</td>
                            </tr>
                            <tr>
                                <th class="first_item">Địa chỉ email :</th>
                                <td>
                                    {{Auth()->user()->email}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary" data-link-action="sign-in" type="submit">
                    <a class="text-light" href="{{route('user.update')}}">Đổi mật khẩu</a>
                </button>
                <div class="order">
                    <h4>Lịch sử
                        <span class="detail">đơn hàng</span>
                    </h4>
                    @foreach($orders as $order)
                    <div class="d-flex align-items-center mt-3">
                        <div class="text-center" style="flex: 1;">{{ count($order->orderDetails) }} sản phẩm</div>
                        <div style="width: 150px;">
                            @if($order->status === 'completed')
                            Hoàn tất
                            @elseif($order->status === 'canceled')
                            Hủy đơn
                            @else
                            Đang đợi
                            @endif
                        </div>
                        <div class="w-25">{{ $order->buy_date }}</div>
                        <div>
                            <button class="btn btn-primary" data-link-action="sign-in" type="submit">
                                <a class="text-light" href="{{route('product.orderdetail',$order->id)}}">Chi tiết</a>
                            </button>
                        </div>
                    </div>
                    @endforeach

                </div>
                <form action="{{route('dangxuat')}}" method='post'>
                    @csrf
                    <button class="btn btn-primary" data-link-action="sign-in" type="submit">
                        Đăng xuất
                    </button>
                </form>
                @else
                <a href="{{route('user.login')}}">Đăng Nhập</a>
                @endif
            </div>

        </div>
    </div>
</div>
@endauth
@endsection