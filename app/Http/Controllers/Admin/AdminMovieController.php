<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Storage;
class AdminMovieController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //
    public function index(){
        $movies = DB::table('movies')
        // ->join('city','city.id','=','theaters.city_id')
        ->get();
        $title = 'Movies';
        return view('admin.movies.listMovies',compact('movies','title'));
    }

    public function addMovie(Request $request){
        $title = 'Add Movie';
        return view('admin.movies.addMovie',compact('title'));
    }

    public function addMoviePost(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'language' => 'required|string',
            'image'=> 'required|file',
            'rating' => 'required|numeric|min:0|max:10',
            'duration' => 'required',
            'release_date' => 'required|date',
            'genre' => 'required|string',
            // 'trailer_url' => 'required|url',
        ]);

        //validation fails return back with validation message 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //if validation successfull 
        //upload image 
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/frontend/images/movie/');
        $image->move($destinationPath, $imageName);

        $movie_id = DB::table('movies')->insertGetId([
            'title' => $request->title,
            'language' => $request->language,
            'image' => $imageName,
            'rating' => $request->rating,
            'duration' => $request->duration,
            'release_date' => $request->release_date,
            'genre' => $request->genre,
            'trailer_url' => $request->trailer_url,
        ]);
        if(!$movie_id){
            return redirect()->back()->with('error','Movie Not Added');
        }
        return redirect()->route('admin.movies')->with('success','Movie Added Successfully');
    }

    public function editMovie(Request $request){
        $movie_id = $request->id;
        $movie = DB::table('movies')->where('id',$movie_id)->first();
        $title = 'Edit Movie';
        return view('admin.movies.editMovie',compact('movie','title'));
    }

    public function updateMoviePost(Request $request){
        //check if old image available then image file not required if image added then required
        if(!$request->hasFile('image')){
            $validator = Validator::make($request->all(), [
                'movie_id' => 'required',
                'title' => 'required|string',
                'language' => 'required|string',
                'rating' => 'required|numeric|min:0|max:10',
                'duration' => 'required',
                'release_date' => 'required|date',
                'genre' => 'required|string',
                // 'trailer_url' => 'required|url',
            ]);
        }else{
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required',
            'title' => 'required|string',
            'image' => 'required|url',
            'language' => 'required|string',
            'rating' => 'required|numeric|min:0|max:10',
            'duration' => 'required',
            'release_date' => 'required|date',
            'genre' => 'required|string',
            // 'trailer_url' => 'required|url',
        ]);
        }   

        //validation fails return back with validation message 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //if validation successfull 
        //upload image 
        //check if file is submitted 
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/frontend/images/movie/');
            $image->move($destinationPath, $imageName);
        }else{
            $imageName = $request->old_image;
        }
        $movie_id = DB::table('movies')->where('id',$request->movie_id)->update([
            'title' => $request->title,
            'language' => $request->language,
            'image' => $imageName,
            'rating' => $request->rating,
            'duration' => $request->duration,
            'release_date' => $request->release_date,
            'genre' => $request->genre,
            'trailer_url' => $request->trailer_url,
        ]);
        if(!$movie_id){
            return redirect()->back()->with('error','Movie Not Updated');
        }
        return redirect()->route('admin.movies')->with('success','Movie Updated Successfully');
    }


    public function deleteMovie(Request $request){
        $movie_id = $request->id;
        //delete movie image from public directory 
        $movie = DB::table('movies')->where('id',$movie_id)->first();
        $image_path = 'public/frontend/images/movie/'.$movie->image;
        //remove path image
        if (Storage::exists($image_path)) {
            Storage::delete($image_path);
        }
        
        $movie = DB::table('movies')->where('id',$movie_id)->delete();
        
        if(!$movie){
            return redirect()->back()->with('error','M`ovie Not Deleted');
        }
        return redirect()->back()->with('success','Movie Deleted Successfully');

    }
}
