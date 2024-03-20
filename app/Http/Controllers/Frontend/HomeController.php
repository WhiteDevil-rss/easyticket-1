<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movies;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Home';
        //get latest 5 movies from database
        $movies = DB::select('SELECT * FROM movies ORDER BY created_at ASC LIMIT 5');
        return view('frontend.index',compact('title','movies'));
    }
}
