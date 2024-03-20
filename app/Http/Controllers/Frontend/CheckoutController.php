<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class CheckoutController extends Controller
{
    //
    public function checkout(Request $request){
        // dd(session()->all(),$request->all());
        if(isset($request->movie_id) || session('request')!= null){
            if(session('request')!= null){
                if(!empty($request->all())){
                    $data = $request->all();
                }else{
                    $request->merge(session('request'));
                }
            }else{
                Session::put('request',$request->all());
            }
            $data = $request->all();
        }else{
            return redirect()->route('movie');
        }
        return view('frontend.movie-checkout',$data);
    }

    public function bookMovie(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'phone' => 'required',
        //     'address' => 'required',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'zip' => 'required',
        //     'card_name' => 'required',
        //     'card_number' => 'required',
        //     'card_cvv' => 'required',
        //     'card_exp_month' => 'required',
        //     'card_exp_year' => 'required',
        // ]);
        $data = $request->all();
        //insert db query to insert data in tickets table
        $payment_id = "1234";
        $tickets = DB::table('tickets')->insertGetId([
            'user_id' => Auth::user()->id,
            'showtime_id' => $request->showtime_id,
            'movie_id' => $request->movie_id,
            'seat_number' => $request->seat,
            'show_date' => Carbon::parse($request->date)->format('Y-m-d'),
            'price' => $request->totalprice,
            'status' => 'pending',
            'payment_id' => $payment_id,
        ]);
        $data['tickets'] = $tickets;
        //book movie and generate ticket
        return redirect()->route('movie.tickets')->with('success','Movie booking successful');
    }
}
