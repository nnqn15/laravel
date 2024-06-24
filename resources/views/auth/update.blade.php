@extends('layout')
@section('title', 'Sửa tài khoản | Furnitica')
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
                        <a href="{{ route('user.dashboard') }}">
                            <span>Tài khoản</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.update') }}">
                            <span>Đổi mật khẩu</span>
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
                        @if(session('success'))
                        <div class="bg-success mb-5 text-light p-3 rounded">{{session('success')}}</div>
                        @endif
                        @if(session('error'))
                        <div class="bg-success mb-5 text-light p-3 rounded">{{session('error')}}</div>
                        @endif
                        <div class="register-form text-center">
                            <h1 class="text-center title-page">Đổi mật khẩu</h1>
                            <form action="{{route('suataikhoan')}}" id="customer-form" class="js-customer-form" method="POST">
                                @csrf
                                <div>
                                    <div class="form-group">
                                        <div>
                                            <div class="input-group js-parent-focus">
                                                <input class="form-control js-child-focus js-visible-password" name="password" type="password" placeholder="Mật khẩu" value='{{old('password')}}'>

                                            </div>
                                            @error('password')
                                            <span class="text-danger text-start">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <div class="input-group js-parent-focus">
                                                <input class="form-control js-child-focus js-visible-password" name="passwordNew" value='{{old('PasswordNew')}}' type="password" placeholder="Nhập lại mật khẩu">

                                            </div>
                                            @error('passwordNew')
                                            <span class="text-danger text-start">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <div class="input-group js-parent-focus">
                                                <input class="form-control js-child-focus js-visible-password" name="repeatPasswordNew" value='{{old('repeatPasswordNew')}}' type="password" placeholder="Nhập lại mật khẩu">

                                            </div>
                                            @error('repeatPasswordNew')
                                            <span class="text-danger text-start">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div>
                                        <button class="btn btn-primary" data-link-action="sign-in" type="submit">
                                            Đổi mật khẩu
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection