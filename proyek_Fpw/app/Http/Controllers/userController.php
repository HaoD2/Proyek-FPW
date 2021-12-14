<?php

namespace App\Http\Controllers;

use App\Models\barangmodel;
use App\Models\request_saldo;
use App\Models\User;
use App\Models\VerificationModel;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;



class userController extends Controller
{
    public function doLogin(Request $req){
        $credentials = $req->validate([
            "email"=> ["required"],
            "password"=>["required"],
        ]);
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            if($user->level == "admin"){
                $req->session()->regenerate();
                $user = user::all()->except(Auth::id());;
                return view('admin',compact('user'));

            }else if ($user->level == "user"){
                if($user->status == 1){
                    $req->session()->regenerate();
                    return view('homepage');
                }else{
                    Auth::logout();
                    Alert::error('Banned', 'Akun anda terkena suspend Ban !!');
                    return redirect('toLogin');
                }
            }
        }else{
            Alert::error('Gagal Login', 'Kredensial yang anda masukkan salah');
            return redirect('toLogin');
        }
    }

    public function isiSaldo(Request $req)
    {
        $valid=[
            "jumlah"=> ["required"],
        ];
        $msg = [
            "input tidak boleh kosong"
        ];
        $this->validate($req,$valid,$msg);
        $user = Auth::user();
        if($user->level == "admin"){
            $req->session()->regenerate();
            $user = user::all()->except(Auth::id());;
            return view('admin',compact('user'));
        }else if ($user->level == "user"){
            if($user->status == 1){
                $namauser = $user->fname . " " . $user->lname;
                request_saldo::create(
                    [
                        "nama_user" => $namauser,
                        "email_user" => $user->email,
                        "jumlah"=>$req->input('jumlah')
                    ]
                );
                Alert::success('Success Topup', 'Menunggu konfirmasi admin, hubungi admin jika saldo tidak bertambah selama 1x24 jam');
                return view('topup');
            }else{
                Auth::logout();
                Alert::error('Banned', 'Akun anda terkena suspend Ban !!');
                return redirect('toLogin');
            }
        }

    }

    public function inputbarang(Request $req)
    {
        $valid=[
            "nama_barang"=> ["required"],
            "deskripsi"=>["required"],
            "harga"=>["required"]
        ];
        $msg = [
            "input tidak boleh kosong"
        ];
        $this->validate($req,$valid,$msg);

        $user = Auth::user();
        if($user->level == "admin"){
            $req->session()->regenerate();
            $user = user::all()->except(Auth::id());;
            return view('admin',compact('user'));
        }else if ($user->level == "user"){
            if($user->status == 1){
                $useremail = $user->email;
                barangmodel::create(
                    [
                        "nama_barang" => $req->input('nama_barang'),
                        "kategori_barang"=>$req->input('kategori'),
                        "deskripsi"=>$req->input('deskripsi'),
                        "harga"=>$req->input('harga'),
                        "email_penjual" => $user->email
                    ]
                );
                Alert::success('Success menginput barang');
                return view('tokoku');
            }else{
                Auth::logout();
                Alert::error('Banned', 'Akun anda terkena suspend Ban !!');
                return redirect('toLogin');
            }
        }

    }

    public function acceptreq(Request $req)
    {
        $reqsaldo=request_saldo::all();
        $id=$req->input('idreq');
        foreach($reqsaldo as $reqsaldo)
        {
            if($reqsaldo->id==$id)
            {
                $emailreq=$reqsaldo->email_user;
                $jumlah=$reqsaldo->jumlah;
            }
        }
        request_saldo::where('id',$id)->delete();
        User::where('email',$emailreq)->update([
            'saldo'=>new Expression('saldo + '.$jumlah),
        ]);

        return view('req_saldo_admin');
    }

    public function rejectreq(Request $req)
    {
        $reqsaldo=request_saldo::all();
        $id=$req->input('idreq');
        request_saldo::where('id',$id)->delete();
        return view('req_saldo_admin');
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
            Alert::error('Gagal Register','Email sudah ada!');
            return back();
        }
        else {
            try {
                User::create(
                    [
                        "fname" => $req->fname,
                        "lname" => $req->lname,
                        "email" => $req->email,
                        "notelp" => $req->telnum,
                        "password" => Hash::make($req->password),
                        "level" => $level,
                        "status"=> $status,
                        "saldo"=>$saldo
                    ]
                );
                Alert::success('Success Register', 'Silahkan masuk ke halaman login');
            } catch (\Exception $e) {
                Alert::error('Gagal Register',$e->getMessage());
            }
            return redirect("/toRegister");
        }
    }

    public function verification(Request $req)
    {
        $data = $req->all();
        if($data['ktp64'] != "" && $data['selfie64'] != "")
        {
            VerificationModel::create(
                [
                    "email"=>Auth::user()->email,
                    "foto" => $data['ktp64'],
                    "selfie" =>$data['selfie64']
                ]
            );
            return response()->json(['success'=>'Sukses Verifikasi, silahkan tunggu respon admin!']);
        }
        else{
            return response()->json(['error'=>'Tidak boleh ada data yang kosong!']);
        }


    }

    public function editprofil(Request $req){
        // $valid=[
        //     "fname"=> ["required"],
        //     "lname"=> ["required"],
        //     "email"=> ["required"],
        //     "telnum"=>["required","digits_between:10,12"],
        // ];
        // $msg = [
        //     "telnum.digits_between:10,12"=>"jumlah angka harus diantara 10-12"
        // ];
        // $this->validate($req,$valid,$msg);
        $temp_data = User::find(Auth::user()->email);
        $temp_data->fname = $req->fname;
        $temp_data->lname = $req ->lname;
        $temp_data->notelp = $req ->telnum;
        $temp_data->save();
        return redirect('/goto_profile');
    }
    public function gantipass(Request $req){
        $valid=[
            "password_confirmation"=>["required"],
            "password"=>["required","confirmed"],
        ];
        $msg = [
           "password.confirmed"=>"password harus sama dengan konfirmasi"
        ];
        $this->validate($req,$valid,$msg);
        $temp_data = User::find(Auth::user()->email);
        $temp_data->password =  Hash::make($req->password);
        $temp_data->save();
        return redirect('/goto_profile');
    }

    public function logout(Request $request) {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }


}
