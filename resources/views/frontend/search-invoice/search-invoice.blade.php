@extends('frontend.layouts.main')

@section('header', 'Tra cứu hóa đơn')

@section('content')
    <div class="content-search-invoice">
        <h1>Tra cứu hóa đơn</h1>
        <hr>
        <form method="POST" action="{{ route('SearchlnvoiceController.searchInvoice') }}">
            @csrf
            <div class="container">
                <div class="form-row justify-content-center">
                    <div class="col-md-5 code">
                        <input type="text" class="form-control" placeholder="Nhập mã hóa đơn..."
                               id="invoice-code" name="invoice-code">
                    </div>
                    <div class="col-md-5 code">
                        <div class="captcha">
                            <button type="button" class="btn" class="reload" id="reload">
                                {!! captcha_img() !!}
                            </button>
                        </div>
                        <div>
                            <input type="text" class="form-control" placeholder="Mã xác thực..."
                                   id="verification-code" name="verification-code">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Tra cứu</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha button").html(data.captcha);
            }
        });
    });
</script>
@endsection
