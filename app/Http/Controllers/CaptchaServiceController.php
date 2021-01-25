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

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function reloadCaptchaCode()
    {
        session_start();
        $string = md5(time());
        $string = substr($string, 0, 4);

        $_SESSION['captcha'] = $string;
        $img = imagecreate(150,50);
        $background = imagecolorallocate($img, 255,255,255);
        $text_color = imagecolorallocate($img, 0,0,0);
        imagestring($img, 15,50,15, $string, $text_color);

        header("Content-type: image/png");
        imagepng($img);
        imagedestroy($img);
    }
}
