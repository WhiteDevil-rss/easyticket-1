<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminCityController extends Controller
{
    //
    public function index(Request $request){
        $title = 'City';
        $city = DB::table('city')->select('id','city_name','created_at')->get();
        return view('admin.city.listCity',compact('title','city'));
    }

    public function addCity(Request $request){
        $title = 'Add City';
        return view('admin.city.addCity',compact('title'));
    }

    public function addCityPost(Request $request){
        $validator = Validator::make($request->all(), [
            'city_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $city_id = DB::table('city')->insertGetId([
            'city_name' => $request->city_name,
        ]);

        if($city_id){
            return redirect()->route('admin.city')->with('success','City added successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function editCity(Request $request){
        $title = 'Edit City';
        $city = DB::table('city')->where('id',$request->id)->first();
        return view('admin.city.editCity',compact('title','city'));
    }

    public function editCityPost(Request $request){
        $validator = Validator::make($request->all(), [
            'city_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $city_id = DB::table('city')->where('id',$request->id)->update([
            'city_name' => $request->city_name,
        ]);

        if($city_id){
            return redirect()->route('admin.city')->with('success','City updated successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function deleteCity(Request $request){
        $city_id = DB::table('city')->where('id',$request->id)->delete();
        if($city_id){
            return redirect()->route('admin.city')->with('success','City deleted successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }
}
