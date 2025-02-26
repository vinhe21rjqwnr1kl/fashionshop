<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;
    protected $primaryKey = 'email'; // Sử dụng 'email' làm khóa chính
    public $timestamps = false;    
    public $incrementing = false; // Vì không có trường auto-increment (id)
    protected $fillable = ['email', 'token', 'created_at'];
 
}
