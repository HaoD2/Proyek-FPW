<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationModel;
use App\Models\isSeller;


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

    public function doCheckVerifySeller(Request $req)
    {
        $data = $req->checkBtn;
        return view('adminconfver', ['data' => $data]);
    }

    public function doVerify(Request $req)
    {
        $data = $req->all();
        if($data['status'] == '1')
        {
            isSeller::create(
                [
                    "email"=>$data['email'],
                    "status" => 1,
                ]
            );
            return response()->json(['success'=>'Sukses Verifikasi, silahkan tunggu respon admin!']);
        }
        return response()->json(['success'=>'Sukses Verifikasi, silahkan tunggu respon admin!']);

    }
}

function alert($msg)
{
    echo "<script>alert('$msg')</script>";

}
