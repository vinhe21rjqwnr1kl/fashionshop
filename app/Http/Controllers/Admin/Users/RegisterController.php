<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.users.register', [
            'title' => 'Đăng ký hệ thống',


        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
          

        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'terms' => 'accepted' // Người dùng phải chọn checkbox
        ]);

        Auth::login($user);

 
        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    
    }
}
