@extends('layouts.app')

@section('content')

<div class="login-box">
   <div class="login-logo">
      <a href=""><b>{!! env('APP_NAME') !!}</b></a>
   </div>
   <!-- /.login-logo -->
   <div class="login-box-body">
        <p class="login-box-msg">{!! __('Đăng nhập vào hệ thống') !!}</p>
        <form action="{{ route('loginGuestPost') }}" method="POST">
            @csrf
            <div class="form-group has-feedback">
                <input id="email" type="text" class="form-control @if( session('error') ) is-invalid @endif"
                    placeholder="{{ __('Tên đăng nhập') }}..."
                    name="email" value='@if( isset( $_GET["email"] ) ) {{ $_GET["email"] }} @endif'
                    required autocomplete="on" autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control @if( session('error') ) is-invalid @endif"
                        name="password" required autocomplete="on" placeholder="{{ __('Mật khẩu') }}...">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                @if( session('errorGuest') )
                    <span class="invalid-feedback mess-danger" role="alert">
                        {{ _('Đăng nhập lỗi!') }}<br />
                        {{ \Session::get('errorGuest') }}
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input class="form-check-input" type="checkbox"
                                name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('Ghi nhớ tài khoản') }}
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-12">
                   <button type="submit" class="btn btn-success btn-block btn-flat">{{ __('Đăng nhập') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!-- /.social-auth-links -->
        <a href="{{ route('password.request') }}">{{ __('Quên mật khẩu') }}</a><br>
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
