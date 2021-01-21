<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SoapClient;

$secret_key = 'E80llAfPt+z6kzVhuQZeg6kDWXYCa30jBbnDZ6gBQeQ=:NzzZqjHyKVdazNHtUJVH4g==';
$key = 'E80llAfPt+z6kzVhuQZeg6kDWXYCa30jBbnDZ6gBQeQ=';
$iv = 'NzzZqjHyKVdazNHtUJVH4g==';
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
        file_put_contents('D:/file.pdf',base64_decode($out));

        // The location of the PDF file
        // on the server
            $filename = "/file.pdf";

        // Header content type
            header("Content-type: application/pdf");

            header("Content-Length: " . filesize($filename));

        // Send the file to the browser.
        echo('2222222222');
        echo(base64_decode($out));
        var_dump($out);

    }

    return $output;
}
$string = '{"CmdType":808, "CommandObject":"1003103"}';
$encrypted_txt = encrypt_decrypt('encrypt', $string, $key, $iv);

$requestParams = array(
    'partnerGUID' => "b371b99b-d764-431e-b85e-232775a83f27",
    'CommandData' => $encrypted_txt
);

$client = new SoapClient('https://wsdemo.ehoadon.vn/WSPublicEhoadon.asmx?WSDL');
$response = $client->ExecCommand($requestParams);

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


