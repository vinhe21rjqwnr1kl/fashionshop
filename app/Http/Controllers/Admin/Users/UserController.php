<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\User\UserService;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    protected $user;
    public function __construct(UserService $user){
        $this->user = $user;
    }
   
      public function index (){
        return view('admin.users.list', [
             'title' => 'Danh Sách user Mới Nhất',
             'users' => $this->user->get()
        ]);
    }
  
   
    public function destroy(Request $request){
        $result = $this->user->destroy($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xoá thành công user'
            ]);

            
        }
        return response()->json(['error' => true]);
    }

    public function toggleRole($id)
    {
        // Tìm kiếm user theo ID
        $user = User::find($id);
        if ($user) {
            // Chuyển đổi role: Nếu role là 1 thì đổi thành 0, ngược lại đổi thành 1
            $user->role = $user->role == 0 ? 1 : 0;
            $user->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%")
                    ->paginate(10);

        return view('admin.users.list',[
            'title' => 'Kết quả tìm kiếm'
        ], compact('users'))->with('query', $query);
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.users.profile',[
            'title' => 'Thông tin người dùng'
        ], compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Kiểm tra và xử lý tải lên hình ảnh
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $path = $file->store('uploads', 'public'); // Lưu tệp vào thư mục public/uploads
            $user->thumb = $path; // Lưu đường dẫn vào database
        }

        // Cập nhật các trường khác
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
