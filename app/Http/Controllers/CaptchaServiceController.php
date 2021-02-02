<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaServiceController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function capthcaFormValidate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'captcha' => 'required|captcha'
        ]);
    }

    public function captcha()
    {
        function randomString($length = 4)
        {
            $str = "";
            $characters = array_merge(range('a', 'z'), range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            return $str;
        }

        //tell the browser that this is an image
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-type: image/png');

        //height and width of the captch image
        $width = 80;
        $height = 30;

        //generate the random code
        $code = randomString();
        session_start();
        $_SESSION['captcha'] = $code;
        //save it in SESSION for furhter form validation

        //create the image resource
        $im = imagecreatetruecolor($width, $height);
        $bg = imagecolorallocate($im, 255, 255, 255); //background color
        $fg = imagecolorallocate($im, 0, 0, 0);//text color

        //fill the image resource with the bg color
        imagefill($im, 0, 0, $bg);

        //Add the random code of string to the image
        imagestring($im, 10, 16, 6, $code, $fg);//imagestring

        //generate the png image
        imagepng($im);

        //destroy the image
        imagedestroy($im);
    }
}
