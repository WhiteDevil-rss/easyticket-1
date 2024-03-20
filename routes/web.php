<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MovieController;
use App\Http\Controllers\Frontend\AboutController;
use app\Http\Controllers\Frontend\contactController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\TicketController;
use App\Http\Controllers\Admin\AdminTheatreController;
use App\Http\Controllers\Admin\AdminMovieController;
use App\Http\Controllers\Admin\AdminMovieShowtimesController;
use App\Http\Controllers\Admin\AdminMovieBookingsController;
use App\Http\Controllers\Admin\AdminCityController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('login',[LoginController::class,'index'])->name('login');

Route::get('movie',[MovieController::class,'index'])->name('movie');

Route::get('about',[AboutController::class,'index'])->name('about');

Route::get('contact',[contactController::class,'index'])->name('contact');
Route::group(['middleware' => 'auth'], function () {
Route::get('movie/checkout',[CheckoutController::class,'checkout'])->name('movie.checkout');
Route::post('movie/checkout',[CheckoutController::class,'checkout'])->name('movie.checkout');
});
Route::get('movie/{name}',[MovieController::class,'show'])->name('movie.show');
Route::get('movie/book/{movie_id}',[MovieController::class,'book'])->name('movie.book');
Route::post('movie/theatre/list',[MovieController::class,'getTheatre' ])->name('get-theatre-list');
Route::get('movie/book/{movie_id}/seatlayout',[MovieController::class,'seatLayout'])->name('movie.seatlayout');
Route::post('movie/book/movie/now',[CheckoutController::class,'bookMovie'])->name('movie.book.movie');
Route::get('movies/tickets/',[TicketController::class,'viewAllTickets'])->name('movie.tickets');
Route::get('movies/tickets/{id}',[TicketController::class,'viewTicket'])->name('movie.ticket.print');

//admin group 
Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
    Route::get('/',[AdminHomeController::class,'index'])->name('admin.home');


    //City list add delete routes
    Route::get('/city',[AdminCityController::class,'index'])->name('admin.city');
    Route::get('/city/add',[AdminCityController::class,'addCity'])->name('admin.city.add');
    Route::post('/city/add',[AdminCityController::class,'addCityPost'])->name('admin.city.add');
    Route::get('/city/edit/{id}',[AdminCityController::class,'editCity'])->name('admin.city.edit');
    Route::post('/city/edit/{id}',[AdminCityController::class,'editCityPost'])->name('admin.city.update');
    Route::get('/city/delete/{id}',[AdminCityController::class,'deleteCity'])->name('admin.city.delete');

    
    Route::get('/movies',[AdminMovieController::class,'index'])->name('admin.movies');
    Route::get('/movies/add',[AdminMovieController::class,'addMovie'])->name('admin.movies.add');
    Route::post('/movies/add',[AdminMovieController::class,'addMoviePost'])->name('admin.movies.add');
    Route::post('/movies/update',[AdminMovieController::class,'updateMoviePost'])->name('admin.movies.update');
    Route::get('/movies/edit/{id}',[AdminMovieController::class,'editMovie'])->name('admin.movies.edit');
    Route::get('/movies/delete/{id}',[AdminMovieController::class,'deleteMovie'])->name('admin.movies.delete');
    
    
    
    Route::get('/screens',[AdminTheatreController::class,'listScreens'])->name('admin.screens');
    Route::get('/screens/add',[AdminTheatreController::class,'addScreen'])->name('admin.screen.add');
    Route::post('/screens/add',[AdminTheatreController::class,'addScreenPost'])->name('admin.screen.add');
    Route::get('/screens/{theater_id}',[AdminMovieShowtimesController::class,'getScreensforTheatre'])->name('admin.screen.theatre_id');
    Route::post('/screens/update',[AdminTheatreController::class,'updateScreenPost'])->name('admin.screen.update');
    Route::get('/screens/edit/{id}',[AdminTheatreController::class,'editScreen'])->name('admin.screen.edit');
    Route::get('/screens/delete/{id}',[AdminTheatreController::class,'deletScreen'])->name('admin.screen.delete');
    
    Route::get('/tickets',[AdminHomeController::class,'tickets'])->name('admin.tickets');
    Route::get('/settings',[AdminHomeController::class,'settings'])->name('admin.settings');
    Route::get('/profile',[AdminHomeController::class,'profile'])->name('admin.profile');
    Route::get('/logout',[AdminHomeController::class,'logout'])->name('admin.logout');
    
    Route::get('/users',[AdminHomeController::class,'users'])->name('admin.users');
    Route::get('/users/add',[AdminHomeController::class,'addUser'])->name('admin.users.add');
    Route::post('/users/add',[AdminHomeController::class,'addUserPost'])->name('admin.users.add');
    Route::post('/users/update/{id}',[AdminHomeController::class,'updateUserPost'])->name('admin.users.update');
    Route::get('/users/edit/{id}',[AdminHomeController::class,'editUser'])->name('admin.users.edit');
    Route::get('/users/delete/{id}',[AdminHomeController::class,'deleteUser'])->name('admin.users.delete');
    
    
    Route::get('/theatres',[AdminTheatreController::class,'index'])->name('admin.theatres');
    Route::get('/theatres/add',[AdminTheatreController::class,'addTheatre'])->name('admin.theatres.add');
    Route::post('/theatres/add',[AdminTheatreController::class,'addTheatrePost'])->name('admin.theatres.add');
    Route::get('/theatre/edit/{id}',[AdminTheatreController::class,'editTheatre'])->name('admin.theatres.edit');
    Route::post('/theatre/update/{id}',[AdminTheatreController::class,'updateTheatrePost'])->name('admin.theatres.update');
    Route::get('/theatre/{city_id}',[AdminMovieShowtimesController::class,'getTheatreByCity'])->name('admin.theatres.city');
    Route::get('/theatre/delete/{id}',[AdminTheatreController::class,'deleteTheatre'])->name('admin.theatres.delete'); 
   
   //Show time management routes
    Route::get('/movie/showtimes/',[AdminMovieShowtimesController::class,'index'])->name('admin.showtimes');
    Route::get('/movie/showtimes/add',[AdminMovieShowtimesController::class,'addShowtime'])->name('admin.showtimes.add');
    Route::post('/movie/showtimes/add',[AdminMovieShowtimesController::class,'addShowtimePost'])->name('admin.showtimes.add');
    Route::get('/movie/showtimes/edit/{id}',[AdminMovieShowtimesController::class,'showTimeEdit'])->name('admin.showtime.edit');
    Route::post('/movie/showtimes/update',[AdminMovieShowtimesController::class,'showtimeUpdatePost'])->name('admin.showtimes.update');
    Route::get('/movie/showtimes/delete/{id}',[AdminMovieShowtimesController::class,'showTimeDelete'])->name('admin.showtime.delete');

    //Ticket Booking Details
    Route::get('/movie/bookings/',[AdminMovieBookingsController::class,'index'])->name('admin.bookings');
    Route::get('/movie/bookings/edit/{id}',[AdminMovieBookingsController::class,'editBooking'])->name('admin.bookings.edit');
    Route::post('/movie/bookings/update/{id}',[AdminMovieBookingsController::class,'updateBookingPost'])->name('admin.bookings.update');
    Route::get('/movie/bookings/delete/{id}',[AdminMovieBookingsController::class,'deleteBooking'])->name('admin.bookings.delete');


    Route::get('/logout',[AdminHomeController::class,'logout'])->name('admin.logout');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
