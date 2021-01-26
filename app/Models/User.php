<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Validator;

class User extends Authenticatable
{
    use Notifiable;

    const PUBLISH = 1;
    const PENDING = 2;
    const DRAFT = 3;
    const DELETED = 4;

    const ROLE_ROOT = 1;
    const ROLE_ADMIN = 2;
    const ROLE_CONTRIBUTOR = 3;
    const ROLE_NORMAL = 4;

    const TYPE_MANAGE = 1;
    const TYPE_PC = 2;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'role', 'type', 'password', 'password_real',
        'phone', 'status', 'created_at', 'updated_at', 'note'
    ];

    public static function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users,phone|max:11',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password'
        ];
    }

    public static function messages()
    {
        return [
            'name.required' => 'Họ và Tên là trường bắt buộc',
            'name.min' => 'Họ và Tên ít nhất 3 ký tự',
            'email.required' => 'Email Không được để trống',
            'email.unique' => 'Email của bạn đã tồn tại',
            'phone.unique' => 'SĐT của bạn đã tồn tại',
            'phone.required' => 'SĐT không được để trống',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password_confirmation.same' => 'Mật khẩu nhập không giống nhau'
        ];
    }

    public static function statusLabelArr() {
        return [
            self::PUBLISH => '<span class="text-green">Hoạt động</button>',
            self::PENDING => '<span class="text-yellow">Chờ duyệt</button>',
            self::DRAFT => '<span class="text-orange">Xóa tạm</button>',
            self::DELETED => '<span class="text-red">Đã xóa</button>',
        ];
    }


    /**
     * Trả về chuỗi string từ status
     * @return giá trị status ở dạng chuỗi hoặc 'N/A' nếu không có.
     */
    public function statusLabelShow()
    {
        $key = $this->status;
        $arr = $this->statusLabelArr();
        if (isset($arr[$key])) {
            return $arr[$key];
        }
        return 'N/A';
    }

    public static function roleArr() {
        return [
            self::ROLE_NORMAL => 'Người dùng thường',
            self::ROLE_CONTRIBUTOR => 'Cộng tác viên',
            self::ROLE_ADMIN => 'Quản trị viên'
        ];
    }
    public function roleShow()
    {
        $key = $this->role;
        $arr = $this->roleArr();
        if (isset($arr[$key])) {
            return $arr[$key];
        }
        return 'N/A';
    }

    public static function typeArr() {
        return [
            self::TYPE_PC => 'PC',
            self::TYPE_MANAGE => 'MANAGE'
        ];
    }
    public function typeShow()
    {
        $key = $this->type;
        $arr = $this->typeArr();
        if (isset($arr[$key])) {
            return $arr[$key];
        }
        return 'N/A';
    }
}
