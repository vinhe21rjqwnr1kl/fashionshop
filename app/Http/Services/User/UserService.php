<?php


namespace App\Http\Services\User;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserService
{
   

   

    public function get() {
        return User::where('role',0)
                       ->orWhere('role',1)
                      ->orderByDesc('id')
                      ->paginate(12);
    }
    

    public function destroy($request){
        $user = User::where('id', $request->input('id'))->first();
        if($user){
            $path = str_replace('storage', 'public', $user->thumb);
            Storage::delete($path);
            $user->delete();
           return true;
        }
        return false;
    }
}