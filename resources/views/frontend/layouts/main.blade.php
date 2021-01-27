<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('header')</title>
    <link rel="stylesheet" type="text/css" href="common/bootrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/custom.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/mobi.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/mmenu-light.css">
    <!-- Styles -->

</head>
<body>
<div class="container">
    <div class="header">
        <a href="#menumobi"><span></span></a>
        <nav id="menumobi">
            <ul>
                <li class="Selected"><a href="{{ route('SearchlnvoiceController.index') }}">Tra cứu</a></li>
                @foreach($pages as $item)
                    <li class="Selected"><a href="{{ $item->slug }}">{{ $item->title }}</a></li>
                @endforeach

                <?php if( empty($_SESSION['username']) ) { ?>
                    <li><a href="{{ route('login') }}">Login</a></li>
                <?php } ?>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </nav>
    </div>

    <div class="logo">
        <img src="img/logo.png" alt="logo">
    </div>
    <div class="menu">
        <ul>
            <li><a href="{{ route('SearchlnvoiceController.index') }}">Tra cứu</a></li>
            @foreach($pages as $item)
                <li class="Selected"><a href="{{ $item->slug }}">{{ $item->title }}</a></li>
            @endforeach

            <?php if( empty($_SESSION['username']) ) { ?>
                <li><a href="{{ route('loginGuest') }}">Login</a></li>
            <?php } ?>
                <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>
</div>

@yield('content')

<div class="footer-box">
    <div class="container">
        <div class="row footer">
            <div class="col-md-4">
                <img src="img/a.png" alt="logo">
                <h4>Hỗ trợ khách hàng</h4>
                <span>Tổng đài: 1900-6154</span>
            </div>
            <div class="col-md-4">
                <img src="img/b.png" alt="logo">
                <h4>Chăm sóc khách hàng</h4>
                <p>(+84) 435 149 016</p>
                <p>Email: support@sts.vn</p>
            </div>
            <div class="col-md-4">
                <img src="img/c.png" alt="logo">
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

<script src="common/jquery/jquery-3.5.1.min.js"></script>
<script src="common/bootrap/js/bootstrap.min.js"></script>
<script src="frontend/js/mmenu-light.js"></script>
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
