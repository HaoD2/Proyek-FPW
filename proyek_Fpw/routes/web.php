<?php

use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('homepage');
});

Route::get('/toLogin', function(){
    return view('login');
});

Route::get('/toRegister', function(){
    return view('register');
});

Route::get('/register', [userController::class,'doRegister'])->name('register');

Route::get('/login', [userController::class,'doLogin'])->name('login');
