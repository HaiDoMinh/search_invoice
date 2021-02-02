@extends('frontend.layouts.main')

@section('header', 'Tra cứu hóa đơn')

@section('content')
    <div class="content-search-invoice">
        <h1>Tra cứu hóa đơn</h1>
        <hr>
        <div class="container">
            <div class="form-row justify-content-center form-box">
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

            <button type="button" class="btn btn-primary btl-lg btn-open" >
                <i class="fa fa-print" aria-hidden="true"></i> In hóa đơn
            </button>
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

        $(".model-button-box").css("display", "none");
        $(".result").css("display", "none");
        $(".result-error span").remove();
        $(".modal-body iframe").remove();

        $.ajax({
            type: 'GET',
            data: {
                docno: docno,
                verification: verification,
            },
            url: 'tra-cuu-hd',
            success: function (data) {

                if(data['success'])
                {
                    $datapdf = '<iframe src="data:application/pdf;base64,' + data['data']['pdf'] + '"></iframe>';
                    $(".modal-body").append($datapdf);
                    $(".model-button-box").css("display", "block");
                    var $input = data['data']['result'];

                    $("#invoiceprefix").append(chekInfor( $input['invoiceprefix'] ));
                    $("#invoiceno").append(chekInfor( $input['invoiceno'] ));
                    $("#buyername").append(chekInfor( $input['buyername'] ));
                    $("#cusinvoicename").append(chekInfor( $input['cusinvoicename'] ));
                    $("#taxid").append(chekInfor( $input['taxid'] ));
                    $("#address").append(chekInfor( $input['address'] ));
                    $("#grandtotal").append(chekInfor( formatNumber($input['grandtotal']) + " VNĐ" ));

                    $(".result").css("display", "block");
                    $(".result-error").css("display", "none");
                }else {
                    $msg = '<span>'+ data['msg'] + '</span>';
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
