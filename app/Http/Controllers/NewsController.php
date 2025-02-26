<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'),[
            'title' => 'Danh sách tin tức'
        ]);
    }
 # Hiển thị danh sách
    public function list()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(5); // Lấy 5 tin tức mới nhất
    
        return view('news.index', compact('news', ),
            [
            'title' => 'Trang tin tức'
        
        ]);
    }
    public function detail($id)
    {
        // Lấy tin tức theo ID
        $news = News::findOrFail($id);
    
        return view('news.detail', [
            'news' => $news,
            'title' => $news->title,
        ]);
    }
    

    public function create()
    {
        return view('admin.news.create', [
            'title' => 'Thêm Tin Tức'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumb' => 'required|string',
        ]);

        News::create($request->only('title', 'content', 'thumb'));

        return redirect()->route('admin.news.index')->with('success', 'Tin tức đã được tạo thành công.');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'),[
            'title' => 'Sửa Tin Tức'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumb' => 'required|string',
        ]);

        $news = News::findOrFail($id);
        $news->update($request->only('title', 'content', 'thumb'));

        return redirect()->route('admin.news.index')->with('success', 'Tin tức đã được cập nhật.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return response()->json(['error' => false, 'message' => 'Tin tức đã được xóa.']);
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
