<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const PUBLISH = 1;
    const PENDING = 2;
    const DELETED = 3;

    protected $table = 'posts';

    protected $fillable = [
        'title', 'content', 'type', 'status', 'created_at', 'updated_at', 'note'
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
}
