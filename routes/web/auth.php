<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PreloaderController;

/*
|--------------------------------------------------------------------------
| Authenticate Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'login' ])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate' ])->name('authenticate');
Route::get('/register', [RegisterController::class, 'register' ])->name('register');
Route::post('/register/new', [RegisterController::class, 'newRegister' ])->name('newRegister');
Route::get('/preloader', [PreloaderController::class, 'index' ])->name('preloader');
Route::get('/logout', [LoginController::class, 'logout' ])->name('logout');
