<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';

    /**
     * Các cột có thể thêm/sửa trong bảng
     */
    protected $fillable = [
        'title',       // Tiêu đề tin tức
        'content',     // Nội dung tin tức
        'thumb',       // Đường dẫn ảnh thumbnail
    ];
}
