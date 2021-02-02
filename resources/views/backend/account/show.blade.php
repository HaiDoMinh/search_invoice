@extends('backend/layouts/master')
@section('stylesheet')
    @parent
@stop
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ __('Thông tin tài khoản') }}</h1>
        <div>
            <small>
                <a class="btn btn-primary btn-sm"
                   href="{!! route('account.index') !!}"><i class="fa fa-list-ul"> {{ __('Danh sách') }}</i></a>
            </small>
            <small>
                <a class="btn btn-success btn-sm"
                   href="{!! route('account.create') !!}"><i class="fa fa-plus"> {{ __('Tạo mới') }}</i></a>
            </small>
        </div>
        <ol class="breadcrumb">
            <li>
                <a href=""><i class="fa fa-dashboard"></i> {{ __('Trang chủ') }}</a>
            </li>
            <li class="active">{{ __('Thông tin tài khoản') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Thông tin tài khoản') }}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                         <table class="table table-striped table-customize table-responsive table-content">
                <tbody>
                    <tr>
                        <td class="hidden-xs hidden-sm"><label>{{ __('Họ và tên') }}</label></td>
                        <td data-title="Họ và tên">
                            {!! !empty( $account->name  ) ? $account->name : '' !!}
                        </td>
                    </tr>
                    <tr>
                        <td class="hidden-xs hidden-sm"><label>{{ __('SĐT') }}</label></td>
                        <td data-title="SĐT">
                            {!! !empty( $account->phone  ) ? $account->phone : '' !!}
                        </td>
                    </tr>
                    <tr>
                        <td class="hidden-xs hidden-sm"><label>{{ __('Mật khẩu') }}</label></td>
                        <td data-title="Mật khẩu">
                           ********
                        </td>
                    </tr>
                    <tr>
                        <td class="hidden-xs hidden-sm"><label>{{ __('Email') }}</label></td>
                        <td data-title="Email">
                            {!! !empty( $account->email  ) ? $account->email : '' !!}
                        </td>
                    </tr>
                    <tr>
                        <td class="hidden-xs hidden-sm"><label>{{ __('Ghi chú') }}</label></td>
                        <td data-title="Ghi chú">
                            {!! !empty( $account->note  ) ? $account->note : '' !!}
                        </td>
                    </tr>
                </tbody>
            </table>
                    </div>
                </div>
            </div>
{{--            <div class="col-md-6">--}}
{{--                <!-- general form elements -->--}}
{{--                <div class="box box-primary">--}}
{{--                    <div class="box-header with-border">--}}
{{--                        <h3 class="box-title">{{ __('Thông tin tài khoản') }}</h3>--}}
{{--                    </div>--}}
{{--                    <!-- /.box-header -->--}}

{{--                    <!-- form start -->--}}
{{--                    <div class="box-body">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('Họ và tên') }} <span class="require">(*)</span></label>--}}
{{--                            <input type="text" class="form-control" name="name"--}}
{{--                                   id="name" placeholder="{{ __('Họ và tên') }}..."--}}
{{--                                   value="{{ $account->name }}" required disabled>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('SĐT') }}</label>--}}
{{--                            <input type="phone" min="0" class="form-control" name="phone"--}}
{{--                                   id="phone" placeholder="{{ __('Số điện thoại') }}..."--}}
{{--                                   value="{!! $account->phone !!}" disabled>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Mật khẩu <span>(*)</span></label>--}}
{{--                            <input type="password" class="form-control" name="password"--}}
{{--                                   id="password" placeholder="Password..." required disabled>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('email') }}</label>--}}
{{--                            <input type="email" min="0" class="form-control" name="email"--}}
{{--                                   id="email" placeholder="{{ __('Email') }}..."--}}
{{--                                   value="{!! $account->email !!}" disabled>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.box-body -->--}}

{{--                </div>--}}
{{--                <!-- /.box -->--}}
{{--            </div>--}}

{{--            <div class="col-md-6">--}}
{{--                <!-- general form elements -->--}}
{{--                <div class="box box-primary">--}}
{{--                    <div class="box-header with-border">--}}
{{--                        <h3 class="box-title">{{ __('Trạng thái tài khoản') }}</h3>--}}
{{--                    </div>--}}
{{--                    <!-- /.box-header -->--}}

{{--                    <!-- form start -->--}}
{{--                    <div class="box-body">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('Trạng thái') }}</label>--}}
{{--                            <select class="form-control" name="status" disabled>--}}
{{--                                @if( !empty( \App\Models\User::statusLabelArr() ) )--}}
{{--                                    @foreach( \App\Models\User::statusLabelArr() as $key => $item )--}}
{{--                                        <option @if( $key == $account->status ) selected @endif--}}
{{--                                        value="{!! $key !!}">--}}
{{--                                            {!! $item !!}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.box-body -->--}}

{{--                </div>--}}
{{--                <!-- /.box -->--}}
{{--            </div>--}}

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <style type="text/css">
        @media (min-width: 768px){
            .content-header h1{
                float: left;
            }
            .content-header div a{
                margin: 0 0 0 5px;
            }
            .table-content td{
                width: 50%;
            }
            .content-header h1{
                float: left;
            }
            .content-header div a{
                margin: 0 0 0 5px;
            }
            table tr td:first-child {
                width: 20%;
            }
        }
        @media (max-width: 769px){
            .content-header div{
                margin: 8px auto;
            }
            .content-header div a{
                margin: 0 5px 0 0;
            }
            .box-footer{
                text-align: center;
            }
            .box-footer button{
                float: none !important;
            }
        }
    </style>

@stop
@section('scripts')
    @parent
@stop
