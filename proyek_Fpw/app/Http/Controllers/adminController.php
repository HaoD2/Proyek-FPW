<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function doBanOrUnban(Request $req){
        $email = $req->input('BanOrUnban');
        $users = User::findorfail($email);
        if($users->status == 1){
            $users->status = 0;
            $users->save();
        }else{
            $users->status = 1;
            $users->save();
        }
        $user = user::all()->except(Auth::id());;
        return view('admin',compact('user'));
    }

}
