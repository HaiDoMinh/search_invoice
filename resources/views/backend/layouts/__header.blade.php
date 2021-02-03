<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>{!! ENV('APP_NAME_MINI') !!}</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{!! ENV('APP_NAME') !!}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="dasboard_brand">
            <a href="" class="navbar-brand">
                <div class="brand-text d-none d-md-inline-block">
                    <strong class="">{!! date('d/m/Y l') !!}</strong>
                </div>
            </a>
        </div>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{!! asset('admin-lte/dist') !!}/img/user2-160x160.jpg" class="user-image"
                                alt="avatar user">
                        <span class="hidden-xs"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{!! asset('admin-lte/dist') !!}/img/user2-160x160.jpg" class="img-circle"
                                    alt="avatar user">
                            <p>
                                <small>@if( !empty( \Auth::user()->name ) ) {!! \Auth::user()->name !!} @endif</small>
                            </p>
                            <p>
                                <small>Ngày tạo: @if( !empty( \Auth::user()->created_at ) ) {!! \Auth::user()->created_at !!} @endif</small>
                            </p>
                        </li>
                        <li class="user-footer" style="background: #33b35a">
                            <div class="pull-left">
                                <a href="{!! route('account.show', ['account' => \Auth::user()->id ]) !!}"
                                    class="btn btn-warning btn-md">Hồ sơ</a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-danger btn-md" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Đăng xuất') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
