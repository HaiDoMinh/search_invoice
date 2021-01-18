<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

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


