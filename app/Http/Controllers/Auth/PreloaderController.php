<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreloaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
         
        return view('auth.preloader',); 
        
    }
}