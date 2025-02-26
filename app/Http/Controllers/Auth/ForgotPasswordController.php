<?php
namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordResetToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    // Hiển thị form quên mật khẩu
    public function showForgotPasswordForm()
    {
        return view('admin.users.forgot-password', ['title' => 'Trang forgot']);
    }

    // Xử lý yêu cầu gửi link reset mật khẩu
    public function sendResetLink(Request $request)
    {
        // Validate email input
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Lấy email
        $email = $request->input('email');
        
        // Tạo token ngẫu nhiên
        $token = Str::random(60);
        
        // Lưu token vào bảng password_reset_tokens mà không cần sử dụng updated_at
        PasswordResetToken::updateOrCreate(
            ['email' => $email], 
            ['token' => $token, 'created_at' => now()]
        );

        // Gửi email chứa liên kết reset mật khẩu
        Mail::send('mail.reset-link', ['token' => $token], function ($message) use ($email) {
            $message->to($email)->subject('Password Reset Link');
        });

        return back()->with('status', 'We have emailed your password reset link!');
    }

    // Hiển thị form để nhập mật khẩu mới
    public function showResetForm($token)
    {
        return view('admin.users.reset-password', ['token' => $token, 'title' => 'Trang Reset']);
    }

    // Xử lý reset mật khẩu
   
public function resetPassword(Request $request)
{
    // Validate input
    $request->validate([
        'token' => 'required|exists:password_reset_tokens,token',
        'password' => 'required|confirmed|min:8',
    ]);

    // Tìm token
    $tokenData = PasswordResetToken::where('token', $request->token)->first();

    // Kiểm tra token có hợp lệ không
    if (!$tokenData || Carbon::parse($tokenData->created_at)->lt(Carbon::now()->subMinutes(60))) {
        return back()->withErrors(['token' => 'This password reset link is invalid or has expired.']);
    }

    // Cập nhật mật khẩu cho user
    $user = \App\Models\User::where('email', $tokenData->email)->first();
    $user->update(['password' => bcrypt($request->password)]);

    // Xóa token đã sử dụng
    $tokenData->delete();

    return redirect()->route('login')->with('success', 'Password reset successful!');
}
}
