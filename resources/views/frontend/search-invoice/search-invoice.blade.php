<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tra cứu hóa đơn</title>
        <link rel="stylesheet" type="text/css" href="common/bootrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="frontend/css/custom.css">
        <!-- Styles -->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="logo col-md-3">
                    <img src="img/logo.png" alt="logo">
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <ul>
                        <li><a href="#">Tra cứu</a></li>
                        <li><a href="#">Hướng dẫn</a></li>
                        <li><a href="#">Thông tư</a></li>
                        <li><a href="#">Câu hỏi thường gặp</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content-search-invoice">
            <h1>Tra cứu hóa đơn</h1>
            <form action="">
                <div class="container">
                    <div class="form-row justify-content-center">
                        <div class="col-md-5 code">
                            <input type="text" class="form-control" placeholder="Nhập mã hóa đơn..."
                                   id="invoice-code" name="invoice-code">
                        </div>
                        <div class="col-md-5 code">
                            <input type="text" class="form-control"  placeholder="Mã xác thực..."
                                   id="verification-code" name="verification-code">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Tra cứu</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

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
