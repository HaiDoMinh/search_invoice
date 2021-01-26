@extends('layouts.app')

@section('content')

<div class="login-box">
   <div class="login-logo">
      <a href=""><b>{!! env('APP_NAME') !!}</b></a>
   </div>
   <!-- /.login-logo -->
   <div class="login-box-body">
        <p class="login-box-msg">{!! __('Reset mật khẩu') !!}</p>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                    autofocus placeholder="{!! __('Email...') !!}">
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" placeholder="{!! __('Mật khẩu') !!}">
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control"
                name="password_confirmation" required autocomplete="new-password" placeholder="{!! __('Xác nhận mật khẩu') !!}">
            </div>
            <div class="form-group has-feedback">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                   <button type="submit" class="btn btn-success btn-block btn-flat">{{ __('Reset Password') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!-- /.social-auth-links -->
        <a href="{{ route('register') }}" class="text-center">{{ __('Đăng ký sử dụng phần mềm') }}</a>
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
