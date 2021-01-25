@extends('frontend.layouts.main')

@section('header', 'Tra cứu hóa đơn')

@section('content')
    <div class="content-search-invoice">
        <h1>Tra cứu hóa đơn</h1>
        <hr>
            <div class="container">
                <div class="form-row justify-content-center">
                    <div class="col-md-5 code">
                        <input type="text" class="invoice-code form-control" placeholder="Nhập mã hóa đơn..."
                               id="invoice-code" name="invoice-code">
                    </div>
                    <div class="col-md-5 code">
                        <div class="captcha">
                            <button type="button" class="btn" class="reload" id="reload">
                                <img src="reload-captcha-code" title="" alt="" />
                            </button>
                        </div>
                        <div class="verification-box">
                            <input type="text" class="form-control" placeholder="Mã xác thực..."
                                   id="verification-code" name="verification-code">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="search btn btn-primary" id="search">Tra cứu</button>
                    </div>
                </div>
            </div>
    </div>

    <div class="result">
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $('#reload').click(function () {
        $(this).find('img').attr('src', 'reload-captcha-code');
    });

    $('#search').click(function () {
        var docno = $(this).closest('.form-row').find('.invoice-code').val();
        var verification = $('#verification-code').val();

        $.ajax({
            type: 'GET',
            data: {
                docno: docno,
                verification: verification,
            },
            url: 'tra-cuu-hd',
            success: function (data) {
                $(".result iframe").remove();
                $(".result span").remove();
                $(".result").append(data);
            }
        });
    });
</script>
@endsection
