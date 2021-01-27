<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    const PUBLISH = 1;
    const PENDING = 2;
    const DELETED = 3;

    protected $table = 'pages';

    protected $fillable = [
        'title', 'content', 'status', 'created_at', 'updated_at', 'note','slug'
    ];

    public static function statusLabelArr() {
        return [
            self::PUBLISH => '<span class="text-green">Hoạt động</button>',
            self::PENDING => '<span class="text-yellow">Chờ duyệt</button>',
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

    public static function forwardNameToUrl($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
        $str = preg_replace("/(Đ)/", 'd', $str);
        $str = preg_replace('/[^a-zA-Z0-9\-_]/', ' ', $str);
        $str = str_replace('-', ' ', $str);
        $str = trim($str);
        $str = preg_replace('/\s\s+/', ' ', trim($str));
        $str = str_replace(' ', '-', $str);

        return strtolower($str);
    }
}
