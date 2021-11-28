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
        $credentials = $req->only('username', 'password');
        if(Auth::attempt($credentials)){
            foreach ($dat_user as $value) {
                if($value->Email == $email){
                    $found = true;
                    if($value->Password == $pass){
                        if($value->status == 1){
                            $users = $value;
                            $user = Auth::user();
                            return view('profile');
                        }else if ($value->status == 0){
                            return redirect('/')->with("akun_Ban","akun anda terkena ban");
                        }
                    }
                }
            }
        }
        if($found == false){
            return redirect('/')->with("error_email","Email/Password ada benar");
        }
    }

    public function logout(Request $request) {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
