@extends('layout')
@section('title', 'Đăng ký | Furnitica')
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
                        <a href="{{ route('user.register') }}">
                            <span>Đăng ký</span>
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
        <div class="row">
            <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">
                <div id="main">
                    <div id="content" class="page-content">
                        <div class="register-form text-center">
                            <h1 class="text-center title-page">Tạo tài khoản</h1>
                            <form action="{{route('dangky')}}" id="customer-form" class="js-customer-form" method="POST">
                                @csrf
                                <div>
                                    <div class="form-group">
                                        <div>
                                            <input class="form-control" name="name" type="text" placeholder="Họ và tên" value='{{old('name')}}'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <input class="form-control" name="email" type="email" placeholder="Email" value='{{old('email')}}'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <div class="input-group js-parent-focus">
                                                <input class="form-control js-child-focus js-visible-password" name="password" type="password" placeholder="Mật khẩu" value='{{old('password')}}'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <div class="input-group js-parent-focus">
                                                <input class="form-control js-child-focus js-visible-password" name="repeatPassword" value='{{old('repeatPassword')}}' type="password" placeholder="Nhập lại mật khẩu">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div>
                                        <button class="btn btn-primary" data-link-action="sign-in" type="submit">
                                            Tạo tài khoản
                                        </button>
                                    </div>
                                </div>
                                @if($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li style="color:red">{{$error}}</li>
                                    @endforeach
                                </ul>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection