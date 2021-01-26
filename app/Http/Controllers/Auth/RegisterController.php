<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'min:9', 'max:11', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'password_confirmation' => 'required_with:password|same:password',
                'accept_term' => ['required'],
            ],
            [
                'name.required' => 'Họ và Tên là trường bắt buộc.',
                'name.min' => 'Họ và Tên ít nhất 3 ký tự.',
                'email.required' => 'Email Không được để trống.',
                'email.unique' => 'Email của bạn đã tồn tại.',
                'phone.unique' => 'SĐT của bạn đã tồn tại.',
                'phone.required' => 'SĐT không được để trống.',
                'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự.',
                'password.required' => 'Mật khẩu là trường bắt buộc.',
                'password_confirmation.same' => 'Mật khẩu nhập không giống nhau.',
                'accept_term.required' => 'Chấp nhận các điều khoản sử dụng dịch vụ của chúng tôi.',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password_real' => $data['password'],
            'password' => Hash::make( $data['password'] ),
            'role' => User::ROLE_NORMAL,
            'type' => User::TYPE_PC,
            'status' => User::PENDING,
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
