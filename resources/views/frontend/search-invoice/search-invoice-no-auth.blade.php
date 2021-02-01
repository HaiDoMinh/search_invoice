@extends('frontend.layouts.main')

@section('header', 'Tra cứu hóa đơn')

@section('content')
    <div class="content-search-invoice">
        <h1>Tra cứu hóa đơn</h1>
        <hr>
        <div class="container">
            <div class="form-row justify-content-center">
                <div class="col-md-4 code invoice-box">
                    <input type="text" class="invoice-code form-control" placeholder="Nhập mã hóa đơn..."
                           id="invoice-code" name="invoice-code">
                </div>
                <div class="col-md-3 code confim-box">
                    <input type="text" class="confim-code form-control" placeholder="Code xác nhận..."
                           id="confim-code" name="confim-code">
                </div>
                <div class="col-md-3 code">
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

            <div class="form-row">
                <div class="col-md-12 show-logo image-box">
                    <img src="{{ asset('img/logo-tsf.png') }}" alt="Logo tamson">
                    <img src="{{ asset('img/KENZO-Logo-new-300x68.png') }}" alt="Logo kenzo">
                    <img src="{{ asset('img/chopard.png') }}" alt="Logo chopard">
                    <img src="{{ asset('img/hermes-logo.png') }}" alt="Logo hermes">
                    <img src="{{ asset('img/bottega-logo.png') }}" alt="Logo bottega">
                    <img src="{{ asset('img/piaget-logo.jpg') }}" alt="Logo piaget">
                    <img src="{{ asset('img/logo-saint.png') }}" alt="Logo saint">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="result-error"></div>

        <div class="row">
            <div class="result col-md-8"></div>
            <div class="model-button-box col-md-4">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-primary btl-lg btn-open" >Hóa đơn</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
{{--                        <h4 class="modal-title">Hóa đơn</h4>--}}
                    <img src="{{ asset('img/logo-tsf.png') }}" alt="Logo tamson">
                    <img src="{{ asset('img/KENZO-Logo-new-300x68.png') }}" alt="Logo kenzo">
                    <img src="{{ asset('img/chopard.png') }}" alt="Logo chopard">
                    <img src="{{ asset('img/hermes-logo.png') }}" alt="Logo hermes">
                    <img src="{{ asset('img/bottega-logo.png') }}" alt="Logo bottega">
                    <img src="{{ asset('img/piaget-logo.jpg') }}" alt="Logo piaget">
                    <img src="{{ asset('img/logo-saint.png') }}" alt="Logo saint">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div id="loading" style="display:none">
        <img src="{{ asset('img/ajax-loader.gif') }}" alt="Loading..."/>
    </div>

@endsection

@section('script')
<script type="text/javascript">

    $(document).ajaxStart(function() {
        $("#loading").show();
    });
    $(document).ajaxStop(function() {
        $("#loading").hide();
    });

    $('.btn-open').click(function () {
        $('#myModal').modal('show');
    });

    $('#reload').click(function () {
        $(this).find('img').attr('src', 'reload-captcha-code');
    });

    $('#search').click(function () {
        var docno = $(this).closest('.form-row').find('.invoice-code').val();
        var verification = $('#verification-code').val();
        var confimCode = $('#confim-code').val();

        $(".model-button-box").css("display", "none");
        $(".result-error span").remove();
        $(".result p").remove();
        $(".modal-body iframe").remove();

        $.ajax({
            type: 'GET',
            data: {
                docno: docno,
                confimCode: confimCode,
                verification: verification,
            },
            url: 'tra-cuu-hd',
            success: function (data) {

                if(data['success'])
                {
                    $datapdf = '<iframe src="data:application/pdf;base64,' + data['data']['pdf'] + '"></iframe>';
                    $(".modal-body").append($datapdf);
                    $(".model-button-box").css("display", "block");

                    $cusinvoicename = '<p>Đơn vị bán hàng: ' +  data['data']['result']['cusinvoicename'] + '</p>';
                    $taxid = '<p>Số fax: ' +  data['data']['result']['taxid'] + '</p>';
                    $address = '<p>Địa chỉ: ' +  data['data']['result']['address'] + '</p>';
                    $grandtotal = '<p>Tổng tiền: ' +  data['data']['result']['grandtotal'] + 'VNĐ</p>';

                    $(".result").append($cusinvoicename, $taxid, $address, $grandtotal);

                }else {
                    $msg = '<span>'+ data['msg'] + '</span>';
                    $(".result-error").append($msg);
                }
                $('#reload').find('img').attr('src', 'reload-captcha-code');
            },
            error: function (data) {
               // console.log(data);
            }
        });
        //$(this).closest('.form-row').find('img').attr('src', 'reload-captcha-code');
    });
</script>
@endsection
