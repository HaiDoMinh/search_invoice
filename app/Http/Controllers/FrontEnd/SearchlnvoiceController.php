<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\BkavModel;

session_start();

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
        $docno = $request['docno'];
        $verification = $request['verification'];

        if( empty( $verification) || $_SESSION['captcha'] != $verification )
        {
            echo "<span>Captcha không đúng</span>";
            return;
        }

        $urlGet = env('API_URL');
        $user = env('API_USER');
        $pass = env('API_PASS');

        $bkav = new BkavModel();
        $status = $bkav->GetDataInvoice( $docno, $user, $pass, $urlGet );
        if(!$status)
        {
            echo "<span>Không tìm thấy hóa đơn. Bạn vui lòng thử lại</span>";
        }
    }

    public function show()
    {
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


