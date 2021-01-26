@extends('backend/layouts/master')
@section('stylesheet')
    @parent
@stop
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ __('Tạo mới') }}</h1>
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
            <li class="active">{{ __('Tạo mới') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form method="POST" action="{!! route('account.store') !!}" enctype="multipart/form-data">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Thông tin tài khoản') }}</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>{{ __('Họ và tên') }} <span class="require">(*)</span></label>
                                <input type="text" class="form-control" name="name"
                                       id="name" placeholder="{{ __('Tên bài viết') }}..."
                                       value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label>{{ __('SĐT') }}</label>
                                <input type="phone" min="0" class="form-control" name="phone"
                                       id="phone" placeholder="{{ __('Số điện thoại') }}..."
                                          value="{!! old('phone') !!}">
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu <span>(*)</span></label>
                                <input type="password" class="form-control" name="password"
                                       id="password" placeholder="Password..." required>
                            </div>
                            <div class="form-group">
                                <label>{{ __('SĐT') }}</label>
                                <input type="email" min="0" class="form-control" name="email"
                                       id="phone" placeholder="{{ __('Email') }}..."
                                       value="{!! old('email') !!}">
                            </div>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Trạng thái tài khoản') }}</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" name="status">
                                    <option value="<?= \App\Models\User::PUBLISH ?>">Hoạt động</option>
                                    <option value="<?= \App\Models\User::PENDING ?>">Ngừng hoạt động</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hình thức</label>
                                <select class="form-control" name="type">
                                    <option value="<?= \App\Models\User::TYPE_PC ?>">Người dùng PC</option>
                                    <option value="<?= \App\Models\User::TYPE_MANAGE ?>">Người dùng Manage</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Vai trò</label>
                                <select class="form-control" name="role">
                                    @if( !empty( $roles ) )
                                        @foreach( $roles as $key => $role )
                                            <option value="{!! $key !!}">{!! $role !!}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Thông tin Khác') }}</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>{{ __('Ghi chú') }}</label>
                                <textarea class="form-control" name="note"
                                    placeholder="{{ __('Ghi chú') }}...">{{ old('note') }}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->
                </div>

                <!--/.col (left) -->
                <div class="col-md-12 box-footer">
                    <button type="submit" class="btn btn-lg btn-success pull-right">
                        <i class="fa fa-save"></i>
                        <span>{{ __('Lưu tạo mới') }}</span>
                    </button>
                </div>
                <!--/.col (right) -->
            </form>
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
