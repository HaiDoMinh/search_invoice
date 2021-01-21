<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SoapClient;

$secret_key = '7LvIo70vxlascqLNeu4iQSluIFmgeQcbU/p7XGFYUiI=:99xFQOkcgSH0ahsmsw6vLw==';
$key = '7LvIo70vxlascqLNeu4iQSluIFmgeQcbU/p7XGFYUiI=';
$iv = '99xFQOkcgSH0ahsmsw6vLw==';
$key = base64_decode($key);
$iv = base64_decode($iv);

function encrypt_decrypt($action, $string, $key, $iv) {
    $output = false;
    $encrypt_method = "AES-256-CBC";

    if ( $action == 'encrypt' ) {
        $compressed = gzencode($string, 9);
        $output = openssl_encrypt($compressed, $encrypt_method, $key, OPENSSL_RAW_DATA, $iv);

        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, OPENSSL_RAW_DATA, $iv);

        $out = gzdecode ($output);
        var_dump($out);
    }

    return $output;
}
$string = '{"CmdType":904, "CommandObject":"0101871229"}';
$encrypted_txt = encrypt_decrypt('encrypt', $string, $key, $iv);

$requestParams = array(
    'partnerGUID' => "947ec492-2afa-4797-a7ab-eaa868b3d535",
    'CommandData' => $encrypted_txt
);

$client = new SoapClient('https://wsdemo.ehoadon.vn/WSPublicEhoadon.asmx?WSDL');
$response = $client->ExecCommand($requestParams);

//var_dump($response);

encrypt_decrypt('decrypt', $response->ExecCommandResult, $key, $iv);

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


