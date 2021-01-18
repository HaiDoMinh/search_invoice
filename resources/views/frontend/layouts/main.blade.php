<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('header')</title>
    <link rel="stylesheet" type="text/css" href="common/bootrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/custom.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/mobi.css">
    <!-- Styles -->
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="img/logo.png" alt="logo">
    </div>
    <div class="menu">
        <ul>
            <li><a href="{{ route('SearchlnvoiceController.index') }}">Tra cứu</a></li>
            <li><a href="{{ route('SearchlnvoiceController.tutorial') }}">Hướng dẫn</a></li>
            <li><a href="{{ route('SearchlnvoiceController.rules') }} ">Thông tư</a></li>
            <li><a href="{{ route('SearchlnvoiceController.frequently_asked_questions') }}">Câu hỏi thường gặp</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>
</div>

@yield('content')

<div class="footer container">
    <div class="row">
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
<script src="common/jquery/jquery-3.5.1.min.js"></script>
<script src="common/bootrap/js/bootstrap.min.js"></script>
</body>
</html>
