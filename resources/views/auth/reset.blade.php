@extends('layout')
@section('title', 'Reset mật khẩu | Furnitica')
@section('content')
<!-- main -->
<div id="wrapper-site">
    <div id="content-wrapper" class="full-width">
        <div id="main">
            <div class="container">
                <h1 class="text-center title-page">Reset mật khẩu</h1>
                <div class="login-form">
                    @if($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="color:red">{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form id="customer-form" action="{{ route('password.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{$token}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <div>
                                    <div class="form-group">
                                        <div>
                                            <div class="input-group js-parent-focus">
                                                <input class="form-control js-child-focus js-visible-password" name="password" type="password" placeholder="Mật khẩu">

                                            </div>
                                            @error('password')
                                            <span class="text-danger text-start">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <div class="input-group js-parent-focus">
                                                <input class="form-control js-child-focus js-visible-password" name="password_confirmation" type="password" placeholder="Nhập lại mật khẩu">

                                            </div>
                                            @error('password_confirmation')
                                            <span class="text-danger text-start">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                        <div class="clearfix">
                            <div class="text-center no-gutters">
                                <input type="hidden" name="submitLogin" value="1">
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
@endsection