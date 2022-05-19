<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\System\UserController;
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
 Route::group(['middleware' => 'auth'], function () {
    Route::get('', function(){return view('home');})->name('home');
    Route::get('/permissions', [PermissionsController::class, 'index'])->name('permissions.index');    
    Route::patch('/dark_mode', [UserController::class, 'dark_mode'])->name('dark_mode');    
});
 
 










