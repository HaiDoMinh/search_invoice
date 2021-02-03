<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Validator;
use Auth;
use Mail;

session_start();

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');//->except('logoutGuest');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $request)
    {

        $rules = [
            'email' => 'required',
            'password' => 'required|min:6'
        ];
        $messages = [
            'email.required' => 'Email Không được để trống',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password.required' => 'Mật khẩu là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        $input = $request->all();

        $remember = true;
        if( !isset($input['remember']) ){
            $remember = false;
        }

        if ($validator->fails()) {
            return redirect()->route('login')->with('error', 'Email, Phone hoặc Mật khẩu không đúng.');

        } else {
            $emailOrPhone = $request->input('email');
            $password = $request->input('password');

            if( is_numeric($request->get('email')) )
            {
                if( \Auth::attempt( ['phone' => $emailOrPhone, 'password' =>$password], $remember ) )
                {
                    if( \Auth::user()->status == \App\Models\User::PUBLISH ){
                        if( Auth::user() )
                        {
                            return redirect()->intended('/admin/pages');
                        }
                        return redirect()->intended('/tra-cuu');
                    } else {
                        \Auth::logout();
                        return redirect()->route('login')->with('error','Tài khoản chưa được kích hoạt.');

                    } //  End check status

                } // End login
            } else {
                if( \Auth::attempt( ['email' => $emailOrPhone, 'password' =>$password], $remember ) )
                {
                    if( \Auth::user()->status == \App\Models\User::PUBLISH ){
                        if( Auth::user() )
                        {
                            return redirect()->intended('/admin/pages');
                        }
                        return redirect()->intended('/tra-cuu');
                    } else {
                        \Auth::logout();
                        return redirect()->route('login')->with('error','Tài khoản chưa được kích hoạt.');

                    } // End check status
                } // End if login
            } // End check email or phone
            return redirect()->route('login')->with('error','Email, Phone hoặc Mật khẩu không đúng.');
        }
    } // End func

    public function logout(Request $request)
    {
        \Auth::logout();
        return redirect()->route('login');
    }

    public function loginGuest(Request $request)
    {
        return view("/auth/loginGuest");
    }

    public function loginGuestPost(Request $request)
    {
        $urlGet = env('API_URL');
        $user = env('API_USER');
        $pass = env('API_PASS');
        $response = Http::withBasicAuth( $user,$pass )->get($urlGet. 'api_getuser',
            [
                "clientid"        =>   1000001,
                "username"        =>   $request['email'],
                "userpass"        =>   $request['password']
            ]);
        $jsonDataUser = $response->json();
        //session_start();

        $_SESSION['username'] = $jsonDataUser['result']['username'];
        $_SESSION['useremail'] = $jsonDataUser['result']['useremail'];
        if(!empty($_SESSION['username']))
        {
            return redirect()->intended('/tra-cuu');
        }

        return redirect()->route('loginGuest')->with('errorGuest', 'Tài khoản không đúng.');
    }

    public function logoutGuest(Request $request)
    {
        if( !empty($_SESSION['username']) ) {

            unset($_SESSION['username']);
            unset($_SESSION['useremail']);
        }

        return redirect()->route('SearchlnvoiceController.index');
    }
}
