<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="@if( !empty( \Auth::user()->image ) ) {!! \Auth::user()->image !!} @else {!! asset('admin-lte/dist') !!}/img/user-160x160.jpg @endif"
                class="img-circle" alt=""}"
                style="height: 45px;">
            </div>
            <div class="pull-left info">
                <p></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
{{--            <li class="header">Trình điều hướng</li>--}}
            <br>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-credit-card"></i>
                    <span>Quản lý pages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('pages.index') }}"><i class="fa fa-list"></i> Tất cả</a></li>
                    <li><a href="{{ route('pages.create') }}"><i class="fa fa-plus-square-o"></i> Thêm mới</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Thành viên</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('account.index') }}"><i class="fa fa-list"></i> Tất cả</a></li>
                    <li><a href="{{ route('account.create') }}"><i class="fa fa-plus-square-o"></i> Thêm mới</a></li>
                </ul>
            </li>
            <li class="alone">
                <a class="btn btn-danger btn-md sidebar-logout" href="{{ route('logout') }}" style="color: #FFF;"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="fa fa-sign-out"></i>
                    {{ __('ĐĂNG XUẤT') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
