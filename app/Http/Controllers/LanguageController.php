<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function index(Request $request,$language)
    {
       // Kiểm tra nếu ngôn ngữ hợp lệ
    if (in_array($language, ['en', 'vi'])) {
        Session::put('language', $language); // Lưu ngôn ngữ vào session
        app()->setLocale($language); // Đặt ngôn ngữ cho ứng dụng
    }

    // Quay lại trang trước đó
    return redirect()->back();
    }
}
