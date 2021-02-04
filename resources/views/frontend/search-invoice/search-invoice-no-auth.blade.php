@extends('frontend.layouts.main')

@section('header', 'Tra cứu hóa đơn')

@section('content')
    <div class="content-search-invoice">
        <h1>Tra cứu hóa đơn</h1>
        <hr>
        <div class="container">
            <div class="form-row justify-content-center form-box">
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
        <div class="result">
            <h4>THÔNG TIN HÓA ĐƠN</h4>
            <div class="form-group">
                <label>Mẫu số: </label>
                <p id ="invoiceprefix"></p>
                <div class="clear"></div>
            </div>
            <div class="form-group">
                <label>Số hóa đơn: </label>
                <p id ="invoiceno"></p>
                <div class="clear"></div>
            </div>
            <div class="form-group">
                <label>Người mua: </label>
                <p id ="buyername"></p>
                <div class="clear"></div>
            </div>
            <div class="form-group">
                <label>Đơn vị bán hàng: </label>
                <p id ="cusinvoicename"></p>
                <div class="clear"></div>
            </div>
            <div class="form-group">
                <label>Mã số thuế: </label>
                <p id ="taxid"></p>
                <div class="clear"></div>
            </div>
            <div class="form-group">
                <label>Địa chỉ: </label>
                <p id ="address"></p>
                <div class="clear"></div>
            </div>
            <div class="form-group">
                <label>Tổng tiền: </label>
                <p id ="grandtotal"></p>
                <div class="clear"></div>
            </div>

            <button type="button" id="btsave" class="btn btn-success btl-lg btn-open">
                <i class="fa fa-download" aria-hidden="true"></i> Tải xuống
            </button>
            <button type="button" id="btprint" class="btn btn-primary btl-lg btn-open" >
                <i class="fa fa-print" aria-hidden="true"></i> In hóa đơn
            </button>

            <a id='dwnldLnk' style="display: none;"></a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
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
    var $pdf, $namepdf;

    $(document).ajaxStart(function() {
        $("#loading").show();
    });
    $(document).ajaxStop(function() {
        $("#loading").hide();
    });

    $('#btprint').click(function () {
        $('#myModal').modal('show');
    });

    $('#btsave').click(function () {
        var dlnk = document.getElementById('dwnldLnk');
        dlnk.href = $pdf;
        dlnk.download = $namepdf;
        dlnk.click();
    });

    $('#reload').click(function () {
        $(this).find('img').attr('src', 'reload-captcha-code');
    });

    $('#search').click(function () {
        var docno = $(this).closest('.form-row').find('.invoice-code').val();
        var verification = $('#verification-code').val();
        var confimCode = $('#confim-code').val();

        $(".model-button-box").css("display", "none");
        $(".result").css("display", "none");
        $(".result-error span").remove();
        $(".modal-body iframe").remove();
        $(".result span").remove();

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
                    $(".result-error span").remove();

                    var $input = data['data']['result'];
                    $namepdf = $input['invoiceprefix'] + '_' + $input['invoiceno'] + '.pdf';

                    $("#invoiceprefix").append('<span>' + chekInfor( $input['invoiceprefix'] ) + '</span>');
                    $("#invoiceno").append('<span>' + chekInfor( $input['invoiceno'] ) + '</span>');
                    $("#buyername").append('<span>' + chekInfor( $input['buyername'] ) + '</span>');
                    $("#cusinvoicename").append('<span>' + chekInfor( $input['cusinvoicename'] ) + '</span>');
                    $("#taxid").append('<span>' + chekInfor( $input['taxid'] ) + '</span>');
                    $("#address").append('<span>' + chekInfor( $input['address'] ) + '</span>');
                    $("#grandtotal").append('<span>' + chekInfor( formatNumber($input['grandtotal']) + " VNĐ" )  + '</span>');

                    $pdf = 'data:application/octet-stream;base64,' + data['data']['pdf'];

                    $(".result").css("display", "block");
                    $(".result-error").css("display", "none");
                }else {
                    $msg = '<span class="error-msg">'+ data['msg'] + '</span>';
                    $(".result-error").css("display", "block");
                    $(".result-error").append($msg);
                }
                $('#reload').find('img').attr('src', 'reload-captcha-code');
            },
            error: function (data) {
               // console.log(data);
            }
        });
    });

    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
    }

    function chekInfor( data ) {
        if(data != null) return data;
        return "";
    }
</script>
@endsection
