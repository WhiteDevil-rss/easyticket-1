<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    //redirect to admin on login by user type admin 
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Auth::check()){
                if(Auth::user()->user_type == "admin")
                    return route('admin');
                else{
                    return route('home');
                }
            }
        }else{
            return route('login');
        }
    }
}
