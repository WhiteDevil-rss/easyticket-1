<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
class AdminTheatreController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function index(){
        $theatres = DB::table('theaters')
        ->select('*','theaters.id as theater_id')
        ->join('city','city.id','=','theaters.city_id')
        ->get();
        $title = 'Theatres';
        return view('admin.theatres.theatres_list',compact('theatres','title'));
    }

    public function addTheatre(Request $request){
        $cities = DB::table('city')->get();
        $title = 'Add Theatre';
        return view('admin.theatres.add_theatre',compact('cities','title'));
    }

    public function addTheatrePost(Request $request){
        $request->validate([
            'name' => 'required',
            'city_id' => 'required',
            'phone_no' => 'required',
            'address' => 'required',
            'is_active' => 'required',
        ]);
        $theatre = DB::table('theaters')->insert([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'phone_no' => $request->phone_no,
            'is_active' => $request->is_active,
        ]);
        if($theatre){
            return redirect()->route('admin.theatres')->with('success','Theatre Added Successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function editTheatre(Request $request){
        $theatre = DB::table('theaters')->where('id',$request->id)->first();
        $cities = DB::table('city')->get();
        $title = 'Edit Theatre';
        return view('admin.theatres.edit_theatre',compact('theatre','cities','title'));
    }

    public function updateTheatrePost(Request $request){
        $request->validate([
            'name' => 'required',
            'city_id' => 'required',
            'phone_no' => 'required',
            'address' => 'required',
            'is_active' => 'required',
        ]);
        $theatre = DB::table('theaters')->where('id',$request->id)->update([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'phone_no' => $request->phone_no,
            'is_active' => $request->is_active,
        ]);
        if($theatre){
            return redirect()->route('admin.theatres')->with('success','Theatre Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function deleteTheatre(Request $request){
        $theatre = DB::table('theaters')->where('id',$request->id)->delete();
        if($theatre){
            return redirect()->route('admin.theatres')->with('success','Theatre Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }


    public function listScreens(Request $request){
        $screens = DB::table('screens')->select('*','screens.id as screen_id','screens.name as screen_name','theaters.name as threatre_name')
        ->join('theaters','theaters.id','=','screens.theaters_id')
        ->join('city','city.id','=','theaters.city_id')
        ->get();
        $title = 'Theatre Screens';
        return view('admin.screens.listScreen',compact('screens','title'));
    }

    public function addScreen(Request $request){
        $city = DB::table('city')->get();
        $theatres = DB::table('theaters')->select('*','theaters.id as theatre_id','theaters.name as theatre_name')
        ->join('city','city.id','=','theaters.city_id')
        ->get();
        $title = 'Add Screen';
        return view('admin.screens.addScreen',compact('theatres','city','title'));
    }

    public function addScreenPost(Request $request){
        //validatior for screenname not present
        $validator = Validator::make($request->all(), [
            'screen_name' => 'required',
            'select_theatre' => 'required',
            'row.*' => 'required',
            'startseatno.*' => 'required',
            'endseatno.*' => 'required',
            'position.*' =>'required',
            'type.*' => 'required',
            'price.*' => 'required',
        ]);
       
        //validation fails return back with validation message 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $screen_id = DB::table('screens')->insertGetId([
            'name' => $request->screen_name,
            'theaters_id' => $request->select_theatre,
            'capacity'=>'0',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //insert data into seats table
        $totalrows = count($request->row);
        for($i=0; $i<$totalrows; $i++){
            for($k=$request->startseatno[$i]; $k<=$request->endseatno[$i];$k++){
            DB::table('seats')->insert([
                'screen_id' => $screen_id,
                'seat_no' => $k,
                'row'=> $request->row[$i],
                'type' => $request->type[$i],
                'position'=> $request->position[$i],
                'price'=>$request->price[$i],
            ]);
            }
        }
        //get total data insert 
        $total_seats = DB::table('seats')->where('screen_id',$screen_id)->count();
        //update total seats in screens table
        DB::table('screens')->where('id',$screen_id)->update([
            'capacity' => $total_seats
        ]);
        return redirect()->route('admin.screens')->with('success','Added successfully');
    }

    public function updateScreenPost(Request $request){
        //validatior for screenname not present 
        $validator = Validator::make($request->all(), [
            'screen_name' => 'required',
            'select_theatre' => 'required',
            'row.*' => 'required',
            'startseatno.*' => 'required',
            'endseatno.*' => 'required',
            'position.*' =>'required',
            'type.*' => 'required',
            'price.*' => 'required',
        ]);
       
        //validation fails return back with validation message 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //update screen name and theatre id
        DB::table('screens')->where('id',$request->screen_id)->update([
            'name' => $request->screen_name,
            'theaters_id' => $request->select_theatre,
            'updated_at' => now()
        ]);

        //delete all seats of that screen
        DB::table('seats')->where('screen_id',$request->screen_id)->delete();

        //insert data into seats table
        $totalrows = count($request->row);
        for($i=0; $i<$totalrows; $i++){
            for($k=$request->startseatno[$i]; $k<=$request->endseatno[$i];$k++){
            DB::table('seats')->insert([
                'screen_id' => $request->screen_id,
                'seat_no' => $k,
                'row'=> $request->row[$i],
                'type' => $request->type[$i],
                'position'=> $request->position[$i],
                'price'=>$request->price[$i],
            ]);
            }
        }
        //get total data insert 
        $total_seats = DB::table('seats')->where('screen_id',$request->screen_id)->count();
        //update total seats in screens table
        DB::table('screens')->where('id',$request->screen_id)->update([
            'capacity' => $total_seats
        ]);
        return redirect()->route('admin.screens')->with('success','Updated successfully');
    }

    public function editScreen(Request $request){
        $screen = DB::table('screens')->select('*','screens.id as screen_id','screens.name as screen_name','theaters.name as theatre_name')
        ->join('theaters','theaters.id','=','screens.theaters_id')
        ->join('city','city.id','=','theaters.city_id')
        ->where('screens.id',$request->id)
        ->first();

        $seats = DB::table('seats')->select('*','seats.seat_id as seat_id','seats.seat_no as seat_no')
        ->join('screens','screens.id','=','seats.screen_id')
        ->where('screens.id',$request->id)
        ->get();

        //get least and max number of seat for particular row and position left right too
        $seat_row = DB::table('seats')->select('row','position','price','type',DB::raw('MIN(seat_no) as min_seat_no'),DB::raw('MAX(seat_no) as max_seat_no'))
        ->where('screen_id',$request->id)
        ->groupBy('row','position','price','type')
        ->get();
        // dd($seat_row);
        $title = 'Edit Screen';
        return view('admin.screens.editScreen',compact('screen','seats','seat_row','title'));
    }

    public function deletScreen(Request $request){
        DB::table('showtimes')->where('screen_id',$request->id)->delete();
        DB::table('seats')->where('screen_id',$request->id)->delete();
        DB::table('screens')->where('id',$request->id)->delete();
        //remove data from showtimes as well
        return redirect()->route('admin.screens')->with('success','Deleted successfully');
    }

}
