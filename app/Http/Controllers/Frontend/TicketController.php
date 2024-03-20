<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    //
    public function viewAllTickets(Request $request){
        $title = 'Tickets';
        $tickets = DB::table('tickets')
        ->join('movies','movies.id','=','tickets.movie_id')
        ->join('showtimes','showtimes.id','=','tickets.showtime_id')
        ->where('user_id',Auth::user()->id)->get();
        return view('frontend.tickets',compact('title','tickets'));
    }
}
