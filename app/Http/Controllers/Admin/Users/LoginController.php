<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;


class LoginController extends Controller
{
    //

    public function index (){
        return view('admin.users.login',[
            'title' => 'Đăng nhập hệ thống',
            

        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);
    
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),      
        ], $request->input('remember'))) {
            $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
    
            // Kiểm tra vai trò của người dùng và định hướng trang tương ứng
            switch ($user->role) {
                case 0:
                    return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
                case 1:
                    return redirect()->route('admin')->with('success', 'Đăng nhập thành công!');
                case 2:
                    return redirect()->route('admin')->with('success', 'Đăng nhập thành công!');
                default:
                    return redirect()->route('home')->with('error', 'Vai trò không hợp lệ.');
            }
        }
    
        Session::flash('error', 'Email hoặc mật khẩu không chính xác.');
        return redirect()->back();
    }
        //  đăng xuất
        public function logout(Request $request)
        {
            Auth::logout(); // Đăng xuất người dùng
    
         
            return redirect('/'); 
        }
}                    