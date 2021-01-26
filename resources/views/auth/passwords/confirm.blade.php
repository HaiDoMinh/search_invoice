@extends('layouts.app')

@section('content')

<div class="login-box">
   <div class="login-logo">
      <a href=""><b>{!! env('APP_NAME') !!}</b></a>
   </div>
   <!-- /.login-logo -->
   <div class="login-box-body">
        <p class="login-box-msg">{{ __('Xác nhận mật khẩu') }}</p>

        {{ __('Vui lòng xác nhận mật khẩu chính xác trước khi tiếp tục.') }}

        <form action="{{ route('password.confirm') }}" method="POST">
            @csrf

            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password" placeholder="{{ __('Mật khẩu"> }}"
            </div>
            <div class="form-group has-feedback">
                @error('password')
                    <span class="invalid-feedback mess-danger" role="alert">
                        <strong>{{ _('Thông tin không phù hợp với hồ sơ của chúng tôi.') }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-xs-12">
                   <button type="submit" class="btn btn-success btn-block btn-flat">
                        {{ __('Confirm Password') }}
                   </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                </div>
                <!-- /.col -->
            </div>
        </form>
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
