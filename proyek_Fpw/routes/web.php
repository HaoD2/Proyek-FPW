<?php

use App\Http\Controllers\ExcelController;
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
})->name('home');

Route::get('/toLogin', function(){
    return view('login');
})->name('toLogin');

Route::get('/toRegister', function(){
    return view('register');
});


Route::get('/register', [userController::class,'doRegister'])->name('register');

Route::get('/login', [userController::class,'doLogin'])->name('login');

Route::get('/getSphread',[ExcelController::class,'getSphreadExcel'])->name('donwload');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', function(){
        return view('admin');
    });
    Route::get('/homepage', function(){
        return view('homepage');
    })->name('homepage');
});
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['auth_verification:admin']], function () {
    	/*
    		Route Khusus untuk role admin
    	*/
        Route::get('/homepage', function(){
            return view('homepage');
        });
    });
    Route::group(['middleware' => ['auth_verification:user']], function () {
    	/*
    		Route Khusus untuk role user
    	*/
        Route::get('/homepage', function(){
            return view('homepage');
        });
    });
});
