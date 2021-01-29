<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use SoapClient;
use \Auth;

class BkavModel extends Model
{
    public function encryptDecrypt($action, $string, $key, $iv)
    {
        $output = false;
        $encryptMethod = "AES-256-CBC";

        if ($action == 'encrypt') {

            $compressed = gzencode($string, 9);
            $output = openssl_encrypt($compressed, $encryptMethod, $key, OPENSSL_RAW_DATA, $iv);

            $output = base64_encode($output);
        } else if ($action == 'decrypt') {

            $output = openssl_decrypt(base64_decode($string), $encryptMethod, $key, OPENSSL_RAW_DATA, $iv);

            $out = gzdecode($output);
            $out = json_decode($out, true);
            $pdf = json_decode($out['Object'], true);

            $output = $pdf['PDF'];
        }
        return $output;
    }
    public function GetDataInvoiceInfo($docno, $user, $pass, $urlGet, $confimCode)
    {
        if ( !empty($_SESSION['username']) || !empty( Auth::user() ))
        {
            $response = Http::withBasicAuth($user, $pass)
                ->get($urlGet . 'api_geteinvoiceinfo',
                    [
                        "docno" => urldecode(strtoupper($docno))
                    ]);
        } else {
            $response = Http::withBasicAuth($user, $pass)
                ->get($urlGet . 'api_geteinvoicemtc',
                    [
                        "docno" => urldecode(strtoupper($docno)),
                        "mtckey" => urldecode($confimCode)
                    ]);
        }

        $jsonDataInvoiceInfo = $response->json();

        return $jsonDataInvoiceInfo;
    }

    public function GetDataInvoice($docno, $user, $pass, $urlGet, $confimCode = null)
    {
        $status = true;
        $jsonDataInvoiceInfo = $this->GetDataInvoiceInfo($docno, $user, $pass, $urlGet, $confimCode);
        if( !empty($jsonDataInvoiceInfo['errorCode'] ))
        {
            $status = false;
            return $status;
        }

        $response = Http::withBasicAuth($user, $pass)->get($urlGet. 'api_getwsinfo',
            [
                "clientid"        =>   (int)$jsonDataInvoiceInfo['result']['ad_client_id'],
                "orgid"           =>   (int)$jsonDataInvoiceInfo['result']['ad_org_id'],
                "warehouseid"     =>   (int)$jsonDataInvoiceInfo['result']['m_warehouse_id'],
                "p_typeehd"       =>    1
            ]);
        $jsonDataWsInfo = $response->json();

        if( !empty($jsonDataInvoiceInfo['errorCode'] ) )
        {
            $status = false;
            return $status;
        }

        $secretKey = $jsonDataWsInfo['result'][0]['passwordapi'];
        $pieces = explode(":", $secretKey);
        $key = base64_decode($pieces[0]);
        $iv = base64_decode($pieces[1]);

        $string = '{"CmdType":808, "CommandObject":"'. $jsonDataInvoiceInfo['result']['einvoiceid'] . '"}';
        $encryptedTxt = $this->encryptDecrypt('encrypt', $string, $key, $iv);

        $requestParams = array(
            'partnerGUID' => $jsonDataWsInfo['result'][0]['usernameapi'],
            'CommandData' => $encryptedTxt
        );

        $client = new SoapClient( $jsonDataWsInfo['result'][0]['ehoadonsoap_address'] . '?WSDL' );
        $response = $client->ExecCommand($requestParams);

        $jsonDataInvoiceInfo['pdf'] = $this->encryptDecrypt('decrypt', $response->ExecCommandResult, $key, $iv );

        return $jsonDataInvoiceInfo;
    }
}
