@extends('layouts.app')

@section('content')

<div class="login-box">
   <div class="login-logo">
      <a href=""><b>{!! env('APP_NAME') !!}</b></a>
   </div>
   <!-- /.login-logo -->
   <div class="login-box-body">
        <p class="login-box-msg">{{ __('Reset Password') }}</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                placeholder="{{ __('Email') }}...">
            </div>
            <div class="form-group has-feedback">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-xs-12">
                   <button type="submit" class="btn btn-success btn-block btn-flat">
                        {{ __('Send Password Reset Link') }}
                   </button>
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
