<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movies;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MovieController extends Controller
{
    public function index()
    {
        $title = 'Movies';
        return view('frontend.movie-list',compact('title'));
    }

    public function show(Request $request){
        $title = 'Movie';
        //DB query to get movie details
        $movie = DB::select('select * from movies where title = "'.$request->name.'" limit 1');
        if(empty($movie)){
            return view('frontend.404');
        }else{
            $movie = $movie[0];
        }
        return view('frontend.movie-details',compact('title','movie'));
    }

    public function book(Request $request){
        if(!empty($request->movie_id)){
            $movie_id = $request->movie_id;
            session('movie_id',$movie_id);
            $date = "";
            $theatre=[];
            $movie = DB::select('select * from movies where id = "'.$request->movie_id.'" limit 1');
            $city = DB::select('select id,city_name, state_id from city');
            if(empty($movie)){
                return view('frontend.404');
            }else{
                $movie = $movie[0];
            }
            $title = 'Show Times '.$movie->title;
            if(!empty($request->city_id)){
                $cityid = $request->city_id;
                $request->session()->put('city_id', $cityid);
                $date = $request->date;
                $request->session()->put('date', $date);
                $showtime = DB::select('select *,theaters.id as theatres_id,theaters.name as theatre_name,st.id as show_id from theaters inner join screens as sc on theaters.id = sc.theaters_id and theaters.city_id inner join showtimes as st on sc.id = st.screen_id where theaters.city_id = "'.$request->city_id.'" and st.movie_id = "'.$request->movie_id.'"');
                $theatredata = [];
                foreach($showtime as $key => $value){
                    $theatredata[$value->theatres_id][] = $value;
                }
                $theatre = DB::select('select * from theaters where city_id = "'.$request->city_id.' and is_active = 1"');
                return view('frontend.movie-ticket-plan',compact('title','movie','city','theatre','cityid','showtime','theatredata','date','movie_id'));
            }
            return view('frontend.movie-ticket-plan',compact('title','movie','city','theatre','movie_id','date'));
        }
    }


    public function seatLayout(Request $request){
        if(!empty($request->screen_id)){
            $movie_id = $request->movie_id;
            $screen_id = $request->screen_id;
            $show_id= $request->show_id;
            $title = 'Seat Layout';
            $seat = DB::select('select * from seats where screen_id = "'.$request->screen_id.' order by row asc"');
            $screens = DB::select('select * from screens where id = "'.$request->screen_id.'" limit 1');
            $showtime = DB::select('select * from showtimes where id = "'.$request->show_id.'" limit 1');
            $seatdata = [];
            foreach($seat as $key => $value){
                $price = $value->price + $showtime[0]->price_factor;
                $seatdata[$value->type." Rs.".$price][$value->row][$value->position][] = $value;
            }
            $theatre = DB::select('select * from theaters where id = "'.$screens[0]->theaters_id.'" limit 1');
            $movie = DB::select('select * from movies where id = "'.$request->movie_id.'" limit 1');
            if(empty($movie)){
                return view('frontend.404');
            }else{
                $movie = $movie[0];
            }
            
            if(empty($seatdata)){
                //no seat available
                return redirect()->route('movie')->with('error','No seat available for this showtime');
            }
            $date = isset($request->date) ? Carbon::parse($request->date)->format('Y-m-d') : Carbon::now()->format('Y-m-d');

            $getbooked_seats = DB::table('tickets')->select('seat_number')->where('showtime_id', $request->show_id)->where('show_date',$date)->where('movie_id',$movie_id)->get();
            $booked_seats = [];
            foreach($getbooked_seats as $key => $value){
                $exploded = explode(',',$value->seat_number);
                foreach($exploded as $k => $v){
                    $booked_seats[] = $v;
                }
            }
            $booked_seats = array_flip($booked_seats);
            return view('frontend.movie-seat-plan',compact('title','seatdata','movie','theatre','screens','movie_id','screen_id','showtime','booked_seats'));
        }
    }




    public function getTheatre(Request $request){
        $theatre = DB::select('select * from theaters where city_id = "'.$request->city_id.' and is_active = 1"');
        return response()->json($theatre);
    }
}
