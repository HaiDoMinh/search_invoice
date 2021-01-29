@extends('backend/layouts/master')
@section('stylesheet')
    @parent
@stop
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('Danh sách Pages') }}
        </h1>
        <div>
            <small>
                <a class="btn btn-success btn-sm"
                   href="{{ route('pages.create') }}"><i class="fa fa-plus"> {{ __('Tạo mới') }}</i></a>
            </small>
        </div>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"> {{ __('Trang chủ') }}</i></a></li>
            <li class="active">{{ __('Danh sách Pages') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content content-list-post">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box">
                    <div class="box-header block-search">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>{!! __('Tìm theo tên pages') !!}</label>
                                        <input type="text" name="search_text" style="float: left;width: 100%;" class="form-control"
                                            placeholder="Nhập tên pages để tìm kiếm..." value="{!! $request->get('search_text') !!}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <div class="input-group">
                                            <button type="submit" class="form-control btn btn-success">
                                                <i class="fa fa-search"> {{ __('Tìm kiếm') }}</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="sorting_desc">{{ __('ID') }}</th>
                                    <th>{{ __('Tên pages') }}</th>
                                    <th>{{ __('Tình trạng') }}</th>
                                    <th>{{ __('Ngày tạo') }}</th>
									<th>{{ __('Ngày cập nhật') }}</th>
                                    <th>{{ __('Thao tác') }}</th>
                                </tr>
                            </thead>
                            <tbody>
								@if( count($pages) > 0 )
                                    @foreach( $pages as $item )
                                        <tr>
                                            <td data-title="ID">{!! $item->id !!}</td>
                                            <td data-title="Tên bài viết">{!! $item->title !!}</td>
                                            <td data-title="Trạng thái">{!! $item->statusLabelShow() !!}</td>
                                            <td data-title="Ngày tạo">{!! !empty($item->created_at) ? date('d/m/Y', strtotime($item->created_at)) : '' !!}</td>
											<td data-title="Ngày cập nhật">{!! !empty($item->updated_at) ? date('d/m/Y', strtotime($item->updated_at)) : '' !!}</td>
                                            <td data-title="Thao tác">
                                                <a class="btn btn-sm btn-info" title="Chi tiết"
                                                   href="{!! route('pages.show', ['page' => $item->id]) !!}">
                                                    <i class="fa fa-eye"> {{ __('Chi tiết') }}</i>
                                                </a>
                                                <a class="btn btn-sm btn-warning" title="Sửa cập nhật"
                                                    href="{!! route('pages.edit', ['page' => $item->id]) !!}">
                                                    <i class="fa fa-edit"> Cập nhật</i>
                                                </a>
                                                <form class="btn btn-sm submit_confirm" style="padding: 1px 0px;" method="POST"
                                                      action="{!! route('pages.destroy', ['page' => $item->id]) !!}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-remove"> Xóa</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                @endif
                            </tbody>
                      </table>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        {{ $pages->links() }}
                    </div>

                </div>
                <!-- /.box -->
            </div>
            <!-- ./col -->
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
    </style>
@stop
@section('scripts')
    @parent
@stop