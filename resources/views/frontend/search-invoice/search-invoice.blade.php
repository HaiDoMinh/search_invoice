@extends('frontend.layouts.main')

@section('header', 'Tra cứu hóa đơn')

@section('content')
    <div class="content-search-invoice">
        <h1>Tra cứu hóa đơn</h1>
        <hr>
        <form action="">
            <div class="container">
                <div class="form-row justify-content-center">
                    <div class="col-md-5 code">
                        <input type="text" class="form-control" placeholder="Nhập mã hóa đơn..."
                               id="invoice-code" name="invoice-code">
                    </div>
                    <div class="col-md-5 code">
                        <input type="text" class="form-control" placeholder="Mã xác thực..."
                               id="verification-code" name="verification-code">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Tra cứu</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

