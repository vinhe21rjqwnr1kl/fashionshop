<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'),[
            'title' => 'Danh sách bài đăng'
        ]);
    }
 # Hiển thị danh sách
    public function list()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(1); // Lấy 5 bài đăng mới nhất
    
        return view('blogs.index', compact('blogs', ),
            [
            'title' => 'Trang bài đăng'
        
        ]);
    }
    public function detail($id)
    {
        // Lấy bài đăng theo ID
        $blogs = Blog::findOrFail($id);
    
        return view('blogs.detail', [
            'blogs' => $blogs,
            'title' => $blogs->title,
        ]);
    }
    

    public function create()
    {
        return view('admin.blogs.create', [
            'title' => 'Thêm bài đăng'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumb' => 'required|string',
        ]);

        Blog::create($request->only('title', 'content', 'thumb'));

        return redirect()->route('admin.blogs.index')->with('success', 'bài đăng đã được tạo thành công.');
    }

    public function edit($id)
    {
        $blogs = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blogs'),[
            'title' => 'Sửa bài đăng'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumb' => 'required|string',
        ]);

        $blogs = Blog::findOrFail($id);
        $blogs->update($request->only('title', 'content', 'thumb'));

        return redirect()->route('admin.blogs.index')->with('success', 'bài đăng đã được cập nhật.');
    }

    public function destroy($id)
    {
        $blogs = Blog::findOrFail($id);
        $blogs->delete();

        return response()->json(['error' => false, 'message' => 'bài đăng đã được xóa.']);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();
                $pathFull = 'uploads/' . date("Y/m/d");
                $path = $request->file('file')->storeAs('public/' . $pathFull, $name);

                return response()->json([
                    'error' => false,
                    'url' => "/storage/{$pathFull}/{$name}",
                ]);
            } catch (\Exception $error) {
                return response()->json(['error' => true, 'message' => 'Upload file lỗi.']);
            }
        }
    }
}
