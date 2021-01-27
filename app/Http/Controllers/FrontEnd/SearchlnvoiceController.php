<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\BkavModel;
use App\Models\Page;
use \Auth;
session_start();

class SearchlnvoiceController extends BaseController
{
    public function index()
    {
        $pages = Page::all();
        if( !empty($_SESSION['username']) || !empty( Auth::user() ))
        {
            return view("/frontend/search-invoice/search-invoice", compact('pages'));
        }
        return view("/frontend/search-invoice/search-invoice-no-auth", compact('pages'));

//        var_dump($_SESSION['username']); dd();
//        if( empty( Auth::user() ) || empty($_SESSION['username']) )
//        {
//            return view("/frontend/search-invoice/search-invoice-no-auth", compact('pages'));
//        }
//         return view("/frontend/search-invoice/search-invoice", compact('pages'));
    }

    public function searchInvoice( Request $request )
    {
        $docno = $request['docno'];
        $confimCode = $request['confimCode'];
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
        $status = $bkav->GetDataInvoice( $docno, $user, $pass, $urlGet, $confimCode );
        if(!$status)
        {
            echo "<span>Không tìm thấy hóa đơn. Bạn vui lòng thử lại</span>";
        }
    }

    public function page( $url )
    {
        $pages = Page::all();
        $page = Page::where('slug', 'LIKE', '%'. $url . '%')->first();

        return view("/frontend/pages/page", compact('page', 'pages'));
    }

}


