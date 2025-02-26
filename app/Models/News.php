<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';

    /**
     * Các cột có thể thêm/sửa trong bảng
     */
    protected $fillable = [
        'title',       // Tiêu đề tin tức
        'content',     // Nội dung tin tức
        'thumb',       // Đường dẫn ảnh thumbnail
    ];
}
