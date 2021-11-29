<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{
    public function doLogin(Request $req){
        $email = $req->input('email');
        $pass = $req->input('pass');
        $found = false;
        $dat_user = User::all();
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

    public function doRegister(Request $req){
        $valid=[
            "fname"=> ["required"],
            "lname"=> ["required"],
            "email"=> ["required"],
            "telnum"=>["required","digits_between:10,12"],
            "password_confirmation"=>["required"],
            "password"=>["required","confirmed"],
        ];
        $msg = [
            "telnum.digits_between:10,12"=>"jumlah angka harus diantara 10-12",
           "pass.confirmed"=>"password harus sama dengan konfirmasi"
        ];
        $this->validate($req,$valid,$msg);
        $check_same = User::where('email','=',$req->email)->get();
        $level= "user";
        $status = "1";
        $saldo = 0;
        if(count($check_same) > 0)
        {
            return response()->json("email already exist !");
        }
        else {
            try {
                User::create(
                    [
                        "fname" => $req->fname,
                        "lname" => $req->lname,
                        "email" => $req->email,
                        "notelp" => $req->telnum,
                        "password" => $req->password,
                        "level" => $level,
                        "status"=> $status,
                        "saldo"=>$saldo
                    ]
                );
            } catch (\Exception $e) {
                return response()->json($e->getMessage());
            }

            return back()->with('msg','Register Success!');
        }
    }

    public function logout(Request $request) {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
