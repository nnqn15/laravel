@extends('layout')
@section('title', 'Đăng nhập | Furnitica')
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
                        <a href="{{ route('user.login') }}">
                            <span>Đăng nhập</span>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </nav>

</div>

<!-- main -->
<div id="wrapper-site">
    <div id="content-wrapper" class="full-width">
        <div id="main">
            <div class="container">
                <h1 class="text-center title-page">Đăng nhập</h1>
                <div class="login-form">
                    @if(session('success'))
                    <div class="bg-success mb-5 text-light p-3 rounded">{{session('success')}}</div>
                    @endif
                    @if($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="color:red">{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form id="customer-form" action="{{route('dangnhap')}}" method="post">
                        @csrf
                        <div>
                            <input type="hidden" name="back" value="my-account">
                            <div class="form-group no-gutters">
                                <input class="form-control" name="email" type="email" placeholder=" Email">
                            </div>
                            <div class="form-group no-gutters">
                                <div class="input-group js-parent-focus">
                                    <input class="form-control js-child-focus js-visible-password" name="password" type="password" value="" placeholder="Mật khẩu">
                                </div>
                            </div>
                            <div class="no-gutters text-center">
                                <div class="forgot-password">
                                    <a href="{{route('user.forgot')}}" rel="nofollow">
                                        Quên mật khẩu?
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="text-center no-gutters">
                                <input type="hidden" name="submitLogin" value="1">
                                <button class="btn btn-primary" data-link-action="sign-in" type="submit">
                                    Đăng nhập
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection