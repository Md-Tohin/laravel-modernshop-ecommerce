<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //  login
    public function login(){
        return view('admin.auth.login');
    }

    //  dashboard
    public function dashboard(){
        return view('admin.dashboard');
    }

    //  all users
    public function allUsers(){
        $users = User::where('role_id', 2)->orderBy('id', 'desc')->get();
        return view('admin.user.index', compact('users'));
    }

    //  user banned
    public function userBanned($id){
        $user = User::findOrFail($id);
        $user->isban = 1;
        $user->save();
        return response()->json(['status' => 200, 'message' => 'User Banned Successfully!']);
    }

    //  user unbanned
    public function userUnbanned($id){
        $user = User::findOrFail($id);
        $user->isban = 0;
        $user->save();
        return response()->json(['status' => 200, 'message' => 'User Unbanned Successfully!']);
    }

    //  get users
    public function getUsers($id=null){
        if ($id == "") {
            $users = User::orderBy('id', 'desc')->get();
            return response()->json(['users' => $users], 200);
        } else {
            $users = User::where('id', $id)->first();
            return response()->json(['users' => $users], 200);
        }        
    }

    //  add user
    public function addUser(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            //  Validation
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ];
            $customMessage = [
                'name.required' => 'Enter your name.',
                'email.required' => 'Enter your email.',
                'email.email' => 'Your email is not Valid.',
                'email.unique' => 'Your email is already taken.',
                'password.required' => 'Enter your password.',
                'password.min' => 'Password must be at least 8 characters',
            ];
            $validator = Validator::make($data, $rules, $customMessage);                
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            //  user store
            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();
            $message = 'User Created Successfully!';
            return response()->json(['message' => $message], 201);
        }
    }

    //  add multi user
    public function addMultiUser(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            //  Validation
            $rules = [
                'users.*.name' => 'required',
                'users.*.email' => 'required|email|unique:users',
                'users.*.password' => 'required|min:8',
            ];
            $customMessage = [
                'users.*.name.required' => 'Enter your name.',
                'users.*.email.required' => 'Enter your email.',
                'users.*.email.email' => 'Your email is not Valid.',
                'users.*.email.unique' => 'Your email is already taken.',
                'users.*.password.required' => 'Enter your password.',
                'users.*.password.min' => 'Password must be at least 8 characters',
            ];
            $validator = Validator::make($data, $rules, $customMessage);                
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            //  user store
            foreach ($data['users'] as $item) {
                $user = new User;
                $user->name = $item['name'];
                $user->email = $item['email'];
                $user->password = Hash::make($item['password']);
                $user->save();
            }            
            $message = 'User Created Successfully!';
            return response()->json(['message' => $message], 201);
        }
    }

    //  update user
    public function updateUser(Request $request, $id){
        if ($request->isMethod('put')) {
            $data = $request->all();
            //  Validation
            $rules = [
                'name' => 'required',
                'password' => 'required|min:8',
            ];
            $customMessage = [
                'name.required' => 'Enter your name.',                
                'password.required' => 'Enter your password.',
                'password.min' => 'Password must be at least 8 characters',
            ];
            $validator = Validator::make($data, $rules, $customMessage);                
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            //  user store
            $user = User::findOrFail($id);
            $user->name = $data['name'];
            $user->password = Hash::make($data['password']);
            $user->save();
            $message = 'User Updated Successfully!';
            return response()->json(['message' => $message], 202);
        }
    }

    //  update single record
    public function updateSingleRecord(Request $request, $id){
        if ($request->isMethod('patch')) {
            $data = $request->all();
            //  Validation
            $rules = [
                'name' => 'required',
            ];
            $customMessage = [
                'name.required' => 'Enter your name.',
            ];
            $validator = Validator::make($data, $rules, $customMessage);                
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            //  user store
            $user = User::findOrFail($id);
            $user->name = $data['name'];
            $user->save();
            $message = 'User Updated Successfully!';
            return response()->json(['message' => $message], 202);
        }
    }

    //  delete user
    public function deleteUser($id){
        User::findOrFail($id)->delete();
        $message = 'User Deleted Successfully!';
        return response()->json(['message' => $message], 200);
    }

    //  delete user with json
    public function deleteUserWithJson(Request $request){
        if($request->isMethod('delete')){
            $data = $request->all();
            User::where('id', $data['id'])->delete();
            $message = 'User Deleted Successfully!';
            return response()->json(['message' => $message], 200);
        }
    }

    //  delete multi user
    public function deleteMultiUser($ids){
        $ids = explode(',', $ids);
        User::whereIn('id', $ids)->delete();
        $message = 'User Deleted Successfully!';
        return response()->json(['message' => $message], 200);
    }

    //  delete multi user with json
    public function deleteMultiUserWithJson(Request $request){
        $header = $request->header('Authorization');
        if ($header == "") {
            $message = 'Authorization is Required';
            return response()->json(['message' => $message], 422);
        } 
        else {
            if ($header == 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6Im1kIHRvaGluIiwiaWF0IjoxNTE2MjM5MDIyfQ.dL0ThQocB0US9Cfpil2q041cqtNxF-NTfJtkUR2GYmk') 
            {
                if($request->isMethod('delete')){
                    $data = $request->all();
                    User::whereIn('id', $data['ids'])->delete();
                    $message = 'User Deleted Successfully!';
                    return response()->json(['message' => $message], 200);
                }
            } 
            else {
                $message = 'Authorization does not match';
                return response()->json(['message' => $message], 422);
            }            
        }       
       
    }

}


