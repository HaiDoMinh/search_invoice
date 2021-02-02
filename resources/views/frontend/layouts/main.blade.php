<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('header')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/STS-W.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('common/bootrap/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/mobi.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/mmenu-light.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('common/fontawesome/css/all.css')}}">
    <!-- Styles -->

</head>
<body>
    <div class="box-content">
        <div class="header-box">
            <div class="header">
                <a href="#menumobi"><span></span></a>
                <nav id="menumobi">
                    <ul>
                        <li class="Selected"><a href="{{ route('SearchlnvoiceController.index') }}">Tra cứu</a></li>
                        @foreach($pages as $item)
                            <li><a href="{{ $item->slug }}">{{ $item->title }}</a></li>
                        @endforeach

                        <?php if( empty($_SESSION['username']) ) { ?>
                            <li><a href="{{ route('loginGuest') }}">Đăng nhập</a></li>
                        <?php } else { ?>
                            <li><a href="{{ route('logoutGuest') }}">Đăng xuất</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>

            <div class="logo">
                <img src="{{ asset('img/logo.png')}}" alt="logo">
            </div>
            <div class="menu">
                <ul>
                    <li class="Selected"><a href="{{ route('SearchlnvoiceController.index') }}">Tra cứu</a></li>
                    @foreach($pages as $item)
                        <li><a href="{{ $item->slug }}">{{ $item->title }}</a></li>
                    @endforeach

                    <?php if( empty( $_SESSION['username'] ) ) { ?>
                        <li><a href="{{ route('loginGuest') }}">Đăng nhập</a></li>
                    <?php } else { ?>
                        <li><a href="{{ route('logoutGuest') }}">Đăng xuất</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        @yield('content')
    </div>
    <div class="footer-box">
        <div class="container">
            <div class="row footer">
                <div class="col-md-4">
                    <a href="#">
                        <img src="{{ asset('img/a.png') }}" alt="logo"/>
                    </a>
                    <h4>Hỗ trợ khách hàng</h4>
                    <span>Tổng đài: 1900-6154</span>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <img src="{{ asset('img/b.png') }}" alt="logo"/>
                    </a>
                    <h4>Chăm sóc khách hàng</h4>
                    <p>(+84) 435 149 016</p>
                    <p>Email: support@sts.vn</p>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <img src="{{ asset('img/c.png') }}" alt="logo"/>
                    </a>
                    <h4>Tư vấn dịch vụ</h4>
                    <p>(028)-3866-4188</p>
                    <p>Email: contact@sts.vn</p>
                </div>
            </div>
        </div>
        <div class="sign-box">
            <p class="left">Copyright © STS 2020. All Rights Reserved.</p>
            <div class="right">
                <a href="">Liên hệ</a>|<a href="">Chính sách riêng tư</a>|<a href="">Điều khoản sử dụng</a>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <script src="{{ asset('common/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('common/bootrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/mmenu-light.js') }}"></script>
    <script src="{{ asset('common/fontawesome/js/all.js') }}"></script>

    <script>
        var menu = new MmenuLight(
            document.querySelector( '#menumobi' ),
            'all'
        );

        var navigator = menu.navigation({
            // selectedClass: 'Selected',
            // slidingSubmenus: true,
            // theme: 'dark',
            // title: 'Menu'
        });

        var drawer = menu.offcanvas({
            // position: 'left'
        });

        //	Open the menu.
        document.querySelector( 'a[href="#menumobi"]' )
            .addEventListener( 'click', evnt => {
                evnt.preventDefault();
                drawer.open();
            });

    </script>

    @yield('script')
</body>
</html>
