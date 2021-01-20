<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function search_invoice( Request $request )
    {
        $docno = $request['invoice-code']; //"HDBp/HER.05/2012/098";

        $response = Http::withBasicAuth('webpos', 'webposapi')
                        ->get('https://apigw.tamsonfashion.com/IDPAPI1/api_geteinvoiceinfo',
                            [
                                "docno" => strtoupper($docno)
                            ]);

        $jsonData = $response->json();
        if($jsonData['errorCode'] == "0089")
        {
            dd("Không tìm thấy hóa đơn. Bạn vui lòng thử lại");
        }
        dd($jsonData);
    }

    public function show()
    {
//        return view("/frontend/rules/rules");
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


