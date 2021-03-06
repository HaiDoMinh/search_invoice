@extends('backend/layouts/master')
@section('stylesheet')
    @parent
@stop
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ __('Cập nhật page') }}</h1>
        <div>
            <small>
                <a class="btn btn-primary btn-sm"
                   href="{!! route('pages.index') !!}"><i class="fa fa-list-ul"> {{ __('Danh sách') }}</i></a>
            </small>
            <small>
                <a class="btn btn-success btn-sm"
                   href="{!! route('pages.create') !!}"><i class="fa fa-plus"> {{ __('Tạo mới') }}</i></a>
            </small>
        </div>
        <ol class="breadcrumb">
            <li>
                <a href=""><i class="fa fa-dashboard"></i> {{ __('Trang chủ') }}</a>
            </li>
            <li class="active">{{ __('Cập nhật page') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form method="POST" action="{!! route('pages.update', ['page' => $page->id]) !!}" enctype="multipart/form-data">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <input type="hidden" name="_method" value="PUT">

                @if( session('error') )
                    <div class="form-group has-feedback alert alert-danger">
                        <span class="invalid-feedback mess-danger" role="alert">
                            {{ _('Cập nhật lỗi!') }}<br />
                            {{ \Session::get('error') }}
                        </span>
                    </div>
                @endif
                    <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Nội dung page') }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>{{ __('Tiêu đề page') }} <span class="require">(*)</span></label>
                                <input type="text" class="form-control" name="title"
                                       id="title" placeholder="{{ __('Tiêu đề page') }}..."
                                       value="{!! $page->title !!}" required>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Nội dung page') }}</label>
                                <textarea type="text" min="0" class="ckediter form-control" name="content"
                                          id="content" placeholder="{{ __('Nội dung page') }}..."
                                          value="{!! $page->content !!}">{!! $page->content !!}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Thông tin page') }}</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>{{ __('Trạng thái') }}</label>
                                <select class="form-control" name="status">
                                    @if( !empty( \App\Models\Page::statusLabelArr() ) )
                                        @foreach( \App\Models\Page::statusLabelArr() as $key => $item )
                                            <option @if( $key == $page->status ) selected @endif
                                            value="{!! $key !!}">
                                                {!! $item !!}
                                            </option>
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
                            <h3 class="box-title">{{ __('Thông tin khác') }}</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>{{ __('Ghi chú') }}</label>
                                <textarea class="form-control" name="note"
                                          placeholder="{{ __('Ghi chú') }}...">{{ $page->note }}</textarea>
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
    <script src="{!! asset('admin-lte/dist/js/pages/dashboard.js') !!}"></script>
    @parent
@stop
