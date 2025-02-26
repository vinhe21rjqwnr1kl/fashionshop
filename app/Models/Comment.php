<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'table_comments';
    protected $fillable = [
        'user_id',
        'content',
        'blog_id'
     ];

       // Định nghĩa mối quan hệ giữa Comment và User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
