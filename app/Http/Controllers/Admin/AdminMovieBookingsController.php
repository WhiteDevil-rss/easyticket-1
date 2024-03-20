<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMovieBookingsController extends Controller
{
    //
    public function index(Request $request){
        $title = 'Movie Bookings';
        //get movie ticket booking details from tickets table
        $bookings = DB::table('tickets')
        ->select('*','tickets.id as bookingsbookings','users.name as user_name')
        ->join('showtimes','showtimes.id','=','tickets.showtime_id')
        ->join('movies','movies.id','=','showtimes.movie_id')
        ->join('screens','screens.id','=','showtimes.screen_id')
        ->join('theaters','theaters.id','=','screens.theaters_id')
        ->join('users','users.id','=','tickets.user_id')
        ->select('tickets.*','tickets.id as ticket_id','showtimes.start_time','showtimes.end_time','showtimes.price_factor','movies.title as movie_name','screens.name as screen_name','theaters.name as theater_name','users.name as user_name')
        ->get();

        return view('admin.bookings.listBookings',compact('title','bookings'));
    }

    public function editBooking(Request $request){
        $title = 'Edit Booking';
        $ticket = DB::table('tickets')->where('id',$request->id)->first();
        return view('admin.bookings.editBooking',compact('title','ticket'));
    }

    public function deleteBooking(Request $request){
        $booking = DB::table('tickets')->where('id',$request->id)->delete();
        //successfuk message on redirect
        return redirect()->route('admin.bookings')->with('success','Ticket Deleted successfully');
    }

    public function updateBookingPost(Request $request){
        //update status of tickets if not completed
        if(isset($request->status)){
            $ticket = DB::table('tickets')->where('id',$request->id)->update([
                'status' => $request->status,
            ]);
            if($ticket){
                return redirect()->route('admin.bookings')->with('success','Ticket Status Updated successfully');
            }
        }else{
            return redirect()->route('admin.bookings')->with('info','Ticket Status is Unchanged.');
        }
    }
}
