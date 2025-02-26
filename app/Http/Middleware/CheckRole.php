<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            // Lấy vai trò của người dùng
            $role = Auth::user()->role;
            // Kiểm tra vai trò có nằm trong danh sách vai trò cho phép không
            if (in_array($role, $roles)) {
                return $next($request);
            }
        }

        // Nếu không có quyền, chuyển hướng đến trang home hoặc trang khác
        return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }
}
