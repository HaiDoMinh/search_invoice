<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\BkavModel;

class SearchlnvoiceController extends BaseController
{

    public function index()
    {
        return view("/frontend/search-invoice/search-invoice");
    }

    public function tutorial()
    {
        return view("/frontend/tutorial/tutorial");
    }

    public function searchInvoice( Request $request )
    {
        $docno = $request['invoice-code']; //"HDBp/HER.05/2012/098";
        $urlGet = env('API_URL');
        $user = env('API_USER');
        $pass = env('API_PASS');

        $bkav = new BkavModel();
        $status = $bkav->GetDataInvoice( $docno, $user, $pass, $urlGet );
        if(!$status)
        {
            dd("Không tìm thấy hóa đơn. Bạn vui lòng thử lại");
        }
    }

    public function show()
    {
//        $bkav = new BkavModel();
//        $bkav->GetDataInvoice();
        return view("/frontend/ShowInvoicePDF");
    }

    public function rules()
    {
        return view("/frontend/rules/rules");
    }

    public function frequently_asked_questions()
    {
        return view("/frontend/frequently-asked-questions/frequently-asked-questions");
    }
}


