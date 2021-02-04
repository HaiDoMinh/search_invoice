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
        $pages = Page::where('status', Page::PUBLISH)->get();

        if( !empty($_SESSION['username']) )
        {
            return view("/frontend/search-invoice/search-invoice", compact('pages'));
        }

        return view("/frontend/search-invoice/search-invoice-no-auth", compact('pages'));
    }

    public function searchInvoice( Request $request )
    {
        $result = ['success'=>false, 'msg' => 'Error'];
        $docno = $request['docno'];
        $confimCode = $request['confimCode'];
        $verification = $request['verification'];

        $urlGet = env('API_URL');
        $user = env('API_USER');
        $pass = env('API_PASS');

        if( empty( \Auth::user() ) && empty( $_SESSION['username'] ) )
        {
            if( empty($confimCode) )
            {
                $result = ['success'=>false, 'msg' => 'Mã hóa đơn, mã xác thực, mã xác nhận không thế để trống'];
                return response()->json($result, 200);
            }
        }

        if( empty($docno) )
        {
            $result = ['success'=>false, 'msg' => 'Mã hóa đơn và mã xác thực không thế để trống'];
            return response()->json($result, 200);

        } else if( empty( $verification) || $_SESSION['captcha'] != $verification )
        {
            $result = ['success'=>false, 'msg' => 'Mã xác thực không đúng'];
            return response()->json($result, 200);
        }

        $bkav = new BkavModel();
        $data = $bkav->GetDataInvoice( $docno, $user, $pass, $urlGet, $confimCode );

        if($data == false)
        {
            $result = ['success'=>false, 'msg' => 'Server lỗi'];
            return response()->json($result, 200);
        }
        if( empty($data) )
        {
            $result = ['success'=>false, 'msg' => 'Không tìm thấy hóa đơn. Bạn vui lòng thử lại'];
        } else{
            $result = ['success'=>true, 'msg' => 'Thành công', 'data' => $data];
        }

        return response()->json($result, 200);
    }

    public function page( $url )
    {
        $pages = Page::where('status',  Page::PUBLISH)->get();
        $page = Page::where('slug', 'LIKE', '%'. $url . '%')->where('status', Page::PUBLISH)->first();
        if( empty($page) )
        {
            return redirect()->route('SearchlnvoiceController.404');
        }

        return view("/frontend/pages/page", compact('page', 'pages'));
    }

    public function page404()
    {
        $pages = Page::where('status',  Page::PUBLISH)->get();
        return view("/frontend/error/404", compact('pages'));
    }
}


