<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //  profile
    public function profile(){
        return view('admin.profile.profile');
    }

    //  update detail
    public function updateDetail(Request $request){
        User::findOrFail(Auth::user()->id)->update($request->all());
        $user = User::findOrFail(Auth::user()->id);
        return response()->json(['status' => 200, 'user' => $user]);
    }

    //  update image
    public function updateImage(Request $request){
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img_name = hexdec(uniqid()).octdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_path = 'assets/uploads/images/profiles/'.$img_name;
            @unlink(Auth::user()->image);
            Image::make($image)->resize(128, 128)->save($save_path);
        }
        User::findOrFail(Auth::user()->id)->update(['image' => $save_path]);
        $user = User::findOrFail(Auth::user()->id);
        return response()->json(['status' => 200, 'user' => $user]);
    }

    //  update password 
    public function updatePassword(Request $request){
        $old_pass = $request->current_password;
        $new_pass = $request->new_password;
        $con_pass = $request->confirm_password;

        if (Hash::check($old_pass, Auth::user()->password)) {
            if ($new_pass === $con_pass) {
                User::findOrFail(Auth::user()->id)->update(['password' => Hash::make($new_pass)]);
                // Auth::logout();
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 502]);
            }            
        } else {
            return response()->json(['status' => 501]);
        }
    }
}
