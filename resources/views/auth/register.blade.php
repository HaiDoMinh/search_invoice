@extends('layouts.app')

@section('content')

<div class="register-box">
   <div class="login-logo">
      <a href=""><b>{!! env('APP_NAME') !!}</b></a>
   </div>
   <!-- /.login-logo -->
   <div class="register-box-body">
        <p class="login-box-msg">{{ __('Đăng ký tài khoản') }}</p>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="hidden" name="package_id" value="{{ isset($_GET['goi']) ? (int)$_GET['goi'] : 0 }}">
            <div class="form-group has-feedback">
                <input id="name" type="text" class="form-control @if ( $errors->has('email') ) is-invalid @endif"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                    placeholder="{!! __('Họ và Tên (*)') !!}...">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control @if ( $errors->has('email') ) is-invalid @endif"
                    name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{!! __('Email (*)') !!}...">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ( $errors->has('email') )
                    <span class="invalid-feedback mess-danger" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback">
                <input id="phone" type="number" class="form-control @if ( $errors->has('phone') ) is-invalid @endif"
                    name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="{!! __('Điện thoại (*)') !!}...">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                @if ( $errors->has('phone') )
                    <span class="invalid-feedback mess-danger" role="alert">
                        {{ $errors->first('phone') }}
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control @if ( $errors->has('password') ) is-invalid @endif"
                    name="password" required autocomplete="new-password" placeholder="{!! __('Mật khẩu') !!}...">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ( $errors->has('password') )
                    <span class="invalid-feedback mess-danger" role="alert">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback">
                <input id="password-confirmation" type="password"
                        class="form-control @if ( $errors->has('password_confirmation') ) is-invalid @endif"
                        name="password_confirmation" required autocomplete="new-password" placeholder="{!! __('Xác nhận lại mật khẩu') !!}...">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ( $errors->has('password_confirmation') )
                    <span class="invalid-feedback mess-danger" role="alert">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input class="form-check-input" type="checkbox"
                                name="accept_term" id="accept_term" {{ old('accept_term') ? 'checked' : '' }}>
                                {{ __('Đồng ý với điều khoản!') }}
                        </label> <br/>
                        @if ( $errors->has('accept_term') )
                            <span class="invalid-feedback mess-danger" role="alert">
                                {{ $errors->first('accept_term') }}
                            </span>
                        @endif
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-12">
                   <button type="submit" class="btn btn-success btn-block btn-flat">{{ __('Đăng ký tài khoản') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!-- /.social-auth-links -->
        <a href="{{ route('password.request') }}">{{ __('Quên mật khẩu') }}</a><br>
        <a href="{{ route('login') }}" class="text-center">{{ __('Đăng nhập nếu đã có tài khoản') }}</a>
   </div>
   <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<style type="text/css">
    .mess-danger{color: red;}
    .login-page, .register-page {
        height: auto;
        background: #d2d6de;
    }
</style>

@endsection
