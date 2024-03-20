<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminMovieShowtimesController extends Controller
{
    //
    public function index(Request $request){
        $title = 'Movie Showtimes';
        $movies = DB::table('movies')->get();
        $theaters = DB::table('theaters')->get();
        $showtimes = DB::table('showtimes')
        ->join('movies','movies.id','=','showtimes.movie_id')
        ->join('screens','screens.id','=','showtimes.screen_id')
        ->join('theaters','theaters.id','=','screens.theaters_id')
        ->select('showtimes.*','showtimes.id as showtime_id','screens.name as screen_name','movies.title as movie_name','theaters.name as theater_name')
        ->get();
        return view('admin.showtimes.listShowtimes',compact('title','movies','theaters','showtimes'));
    }

    public function addShowTime(Request $request){
        $title = 'Add Showtime';
        $city = DB::table('city')->orderBy('city_name','asc')->get();
        $movies = DB::table('movies')->get();
        $theaters = DB::table('theaters')->get();
        $screens = DB::table('screens')->get();
        return view('admin.showtimes.addShowtime',compact('title','movies','theaters','screens','city'));
    }

    public function getScreensforTheatre(Request $request){
        $screens = DB::table('screens')->where('theaters_id',$request->theater_id)->get();
        return response()->json($screens);
    }

    public function getTheatreByCity(Request $request){
        $theaters = DB::table('theaters')->where('city_id',$request->city_id)->get();
        return response()->json($theaters);
    }

    public function addShowtimePost(Request $request){
        $request->validate([
            'movie' => 'required',
            'screen' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
            'price_factor' => 'required',
        ]);
        $showtime = DB::table('showtimes')->insert([
            'movie_id' => $request->movie,
            'screen_id' => $request->screen,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'price_factor' => $request->price_factor,
            'is_active' => $request->status,
       ]);
        if($showtime){
            return redirect()->route('admin.showtimes')->with('success','Showtime Added Successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }
    public function showTimeEdit(Request $request){
        $title = 'Edit Showtime';
        $showtime = DB::table('showtimes')->select('*','showtimes.id as showtimes_id','showtimes.is_active as showtime_is_active','movies.id as movie_id','theaters.id as theaters_id','screens.id as screen_id')->where('showtimes.id',$request->id)
        ->join('movies','movies.id','showtimes.movie_id')
        ->join('screens','screens.id','showtimes.screen_id')
        ->join('theaters','theaters.id','screens.theaters_id')
        ->first();
        $movies = DB::table('movies')->where('id',$showtime->movie_id)->get();
        $theaters = DB::table('theaters')->get();
        $screens = DB::table('screens')->where('theaters_id',$showtime->theaters_id)->get();
        $city = DB::table('city')
        ->select('city.id as city_id','city.city_name as city_name')
        ->join('theaters','theaters.city_id','city.id')
        ->join('screens','screens.theaters_id','theaters.id')
        ->where('screens.id',$showtime->screen_id)
        ->first();

        return view('admin.showtimes.editShowtime',compact('title','showtime','movies','theaters','screens','city'));
    }

    public function showtimeUpdatePost(Request $request){
        $request->validate([
            'showtime_id' => 'required',
            'movie' => 'required',
            'screen' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
            'price_factor' => 'required',
        ]);
        $showtime = DB::table('showtimes')->where('id',$request->showtime_id)->update([
            'movie_id' => $request->movie,
            'screen_id' => $request->screen,
            'start_time' => Carbon::parse($request->start_time)->format('Y-m-d H:i:s').'.000000',
            'end_time' => Carbon::parse($request->end_time)->format('Y-m-d H:i:s').'.000000',
            'price_factor' => $request->price_factor,
            'is_active' => $request->status,
       ]);
        if($showtime){
            return redirect()->route('admin.showtimes')->with('success','Showtime Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function showTimeDelete(Request $request){
        $showtime = DB::table('showtimes')->where('id',$request->id)->delete();
        if($showtime){
            return redirect()->route('admin.showtimes')->with('success','Showtime Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }
}
