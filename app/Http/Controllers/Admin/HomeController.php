<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Validator;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function index(){
        $title = 'Dashboard';
        return view('admin.home',compact('title'));
    }

    public function users(){
        $users = DB::table('users')->select('name','email','user_type','id','created_at')->get();
        $title = 'Users';

        return view('admin.users.users_list',compact('users','title'));
    }

    public function addUser(Request $request){
        $title = 'Add User';
        return view('admin.users.add_user',compact('title'));
    }

    public function addUserPost(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'user_type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_id = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => $request->user_type,
        ]);

        if($user_id){
            return redirect()->route('admin.users')->with('success','User added successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function editUser(Request $request){
        $user = DB::table('users')->where('id',$request->id)->first();
        $title = 'Edit User';
        return view('admin.users.edit_user',compact('title','user'));
    }

    public function updateUserPost(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'user_type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_id = DB::table('users')->where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type,
        ]);

        if($user_id){
            return redirect()->route('admin.users')->with('success','User updated successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function deleteUser(Request $request){
        $user_id = DB::table('users')->where('id',$request->id)->delete();
        if($user_id){
            return redirect()->route('admin.users')->with('success','User deleted successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function logout(){
        Auth::logout();
        Cache::flush();
        return redirect()->route('login');
    }
}
