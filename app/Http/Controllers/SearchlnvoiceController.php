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

    public function search_invoice()
    {

        $response = Http::withBasicAuth('admin', 'admin')
            ->get('http://192.168.20.60:3001/rpc/api_getallcountry');

        $jsonData = $response->json();

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


