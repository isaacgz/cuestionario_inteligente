<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected $redirectTo = '/';

    public function login()
    {
        if(Auth::check()){
            return view('home');
        }else{
            return view('auth.login');
        }
    }

    public function authenticate(Request $request)
    {  
        if(Auth::attempt(['email' => $request->json('email'), 'password' => $request->json('password')], false  )){
            if(auth()->user()->active == 1){
                Log::channel('auth')->info('[login][Authenticated user, IP address: '.request()->ip().']['.Auth::id().']['.Auth::id().']');
                return response()->json([url('preloader')],200);    
            }else{
                return response()->json(null,422);    
            }  
        }else{
            return response()->json(null,422);
        } 
    }

    public function logout()
    {
        Log::channel('auth')->info('[logout][Log out]['.Auth::id().']['.Auth::id().']');
        Auth::logout();
        return view('auth.login');
    }
}
