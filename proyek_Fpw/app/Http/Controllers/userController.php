<?php

namespace App\Http\Controllers;

use App\Models\userModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{
    public function doLogin(Request $req){
        $email = $req->input('email');
        $pass = $req->input('pass');
        $found = false;
        $dat_user = userModel::all();
        $credentials = $req->only('email', 'pass');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            if($user->level == "admin"){
                return redirect()->route('admin');
            }else if ($user->level == "user"){
                return redirect()->route('homepage');
            }
        }
        return redirect('');
    }

    public function logout(Request $request) {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
