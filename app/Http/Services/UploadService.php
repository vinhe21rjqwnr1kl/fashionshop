<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class UploadService
{
    public function store($request){
        if($request->hasFile('file')){
            try{
                $name = $request->file('file')->getClientOriginalName();
                $pathFull = 'uploads/' .date("Y/m/d");
                $request->file('file')->storeAs(
                    'public/'. $pathFull, $name
                );
    
                return "/storage/{$pathFull}/{$name}";
            } catch(\Exception $error){
                return false;
            }
           
        }
    }
}