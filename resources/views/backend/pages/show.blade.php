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
            <li class="active">{{ __('Tạo mới') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('Nội dung bài viết') }}</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ __('Tiêu đề bài viết') }} <span class="require">(*)</span></label>
                            <input type="text" class="form-control" name="title"
                                   id="title" placeholder="{{ __('Tên bài viết') }}..."
                                   value="{!! $page->title !!}" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Nội dung bài viết') }}</label>
                            <textarea type="text" min="0" class="ckediter form-control" name="content" rows="9" cols="70"
                                      id="content" placeholder="{{ __('Nội dung bài viết') }}..."
                                      value="">{!! $page->content !!}</textarea>
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
                        <h3 class="box-title">{{ __('Thông tin bài viết') }}</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ __('Trạng thái') }}</label>
                            <select class="form-control" name="status">
                                @if( !empty( \App\Models\Page::statusLabelArr() ) )
                                    @foreach( \App\Models\Page::statusLabelArr() as $key => $item )
                                        <option @if( $key == old('status') ) selected @endif
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
                        <h3 class="box-title">{{ __('Thông tin Khác') }}</h3>
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
            <!--/.col (right) -->
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
