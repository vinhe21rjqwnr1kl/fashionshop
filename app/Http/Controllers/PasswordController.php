<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
      // Hiển thị form đổi mật khẩu
      public function showChangePasswordForm()
      {
          return view('admin.users.change-password',[
            'title' => 'Đổi mật khẩu'
          ]);
      }
  
      // Xử lý yêu cầu đổi mật khẩu
      public function updatePassword(Request $request)
      {
          // Xác thực các trường nhập
          $request->validate([
              'current_password' => 'required',
              'new_password' => 'required|min:8|confirmed',
          ]);
  
          // Kiểm tra mật khẩu hiện tại có khớp với mật khẩu người dùng không
          if (!Hash::check($request->current_password, Auth::user()->password)) {
              return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
          }
  
          // Cập nhật mật khẩu mới cho người dùng
          Auth::user()->update([
              'password' => Hash::make($request->new_password),
          ]);
  
          return redirect()->route('home')->with('success', 'Đổi mật khẩu thành công.');
      }
}
