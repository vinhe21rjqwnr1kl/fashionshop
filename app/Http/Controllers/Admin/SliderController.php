<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Slider\SliderService;
use Illuminate\Http\Request;
use App\Models\Slider;
class SliderController extends Controller
{
    protected $slider;
    public function __construct(SliderService $slider){
        $this->slider = $slider;
    }
    public function create(){
        return view('admin.slider.add', [
            'title' => 'Thêm Slide Mới'
        ]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'thumb' => 'required|max:255',
            
        ]);

      $result =  $this->slider->insert($request);
      if($result){
        return redirect('admin/sliders/list');

      }
        return redirect()->back();
    }
    public function index (){
        return view('admin.slider.list', [
             'title' => 'Danh Sách Slider Mới Nhất',
             'sliders' => $this->slider->get()
        ]);
    }
    public function show(Slider $slider){
        return view('admin.slider.edit', [
            'title' => 'Chỉnh Sửa Slider',
            'slider' => $slider
       ]);
    }
    public function update(Request $request,Slider $slider){
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
            'url'=> 'required'
        ]);

        $result = $this->slider->update($request, $slider);
        if($result){
            return redirect('admin/sliders/list');
        }
        return redirect()->back();
    }
    public function destroy(Request $request){
        $result = $this->slider->destroy($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xoá thành công Slider'
            ]);

            
        }
        return response()->json(['error' => true]);
    }
}
