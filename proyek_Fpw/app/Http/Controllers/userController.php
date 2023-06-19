<?php

namespace App\Http\Controllers;

use App\Models\barangmodel;
use App\Models\request_saldo;
use App\Models\Cart;

use App\Models\User;
use App\Models\VerificationModel;
use Barang;
use Facade\Ignition\DumpRecorder\Dump;
use GuzzleHttp\Psr7\Message;
use Hjual;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use function App\Http\Controllers\alert as ControllersAlert;

class userController extends Controller
{
    public function doLogin(Request $req){
        $credentials = $req->validate([
            "email"=> ["required"],
            "password"=>["required"],
        ]);
        if(Auth::attempt($credentials)){
            $user = Auth::Akun();
            if($user->level == "admin"){
                $req->session()->regenerate();
                $user = Akun::all()->except(Auth::id());;
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
                return redirect('tokoku');
            }else{
                Auth::logout();
                Alert::error('Banned', 'Akun anda terkena suspend Ban !!');
                return redirect('toLogin');
            }
        }

    }

    public function updatebarang(Request $req){
        $valid=[
            "nama_barang"=> ["required"],
            "kategori_barang"=>["required"],
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
                $temp_data = barangmodel::where('nama_barang',"=",$req->nama_barang)->where('email_penjual','=',Auth::user()->email)->first();
                $temp_data->nama_barang = $req->nama_barang;
                $temp_data->kategori_barang = $req ->kategori_barang;
                $temp_data->deskripsi = $req ->deskripsi;
                $temp_data->harga = $req ->harga;
                $temp_data->save();
                Alert::success('Success update barang');
                return redirect('tokoku');
            }else{
                Auth::logout();
                Alert::error('Banned', 'Akun anda terkena suspend Ban !!');
                return redirect('toLogin');
            }
        }
    }

    public function deletebarang(Request $req){
        $user = Auth::user();
        if($user->level == "admin"){
            $req->session()->regenerate();
            $user = user::all()->except(Auth::id());;
            return view('admin',compact('user'));
        }else if ($user->level == "user"){
            if($user->status == 1){
                barangmodel::where('id',"=",$req->id)->where('email_penjual','=',Auth::user()->email)->delete();
                Alert::success('Success delete barang');
                return redirect('tokoku');
            }else{
                Auth::logout();
                Alert::error('Banned', 'Akun anda terkena suspend Ban !!');
                return redirect('toLogin');
            }
        }
    }



    public function gotoupdate(Request $req)
    {
        $id=$req->input('id');
        $data_barang=db::table('barang')->where('id','=',$id)->get();
        $data_barang=json_encode($data_barang);
        return view('tokoku-update',['data_barang'=>$data_barang]);
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
        VerificationModel::create(
            [
                "email"=>Auth::user()->email,
                "foto" => $data['ktp64'],
                "selfie" =>$data['selfie64']
            ]
        );
        return response()->json(['success'=>'Sukses Verifikasi, silahkan tunggu respon admin!']);
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

    public function getKatData(Request $req)
    {
        $data = $req->all();
        $item = DB::table('barang')->where('kategori_barang', '=',$data["id"])->get();
        $send = json_encode($item);
        return response()->json(['success'=>$send]);

    }

    public function addtoCart(Request $req)
    {
        $data = $req->all();

        try{
            $mycart = DB::table('cart')->where("id_barang", "=", $data["id"])
            ->where("email", '=', Auth::user()->email)->first();

            if($mycart != null)
            {
                return response()->json(['success'=>"udh ada"]);

            }
            else{
                Cart::create(
                    [
                        "email" => Auth::user()->email,
                        "id_barang" => $data["id"],
                        "jumlah" => 1
                    ]
                );
                return response()->json(['success'=>"sukses"]);
            }

        }
        catch(\Exception $e)
        {
            return response()->json(['success'=>$e]);

        }

    }

    public function checkout(Request $req)
    {
       $totalpesan = intval($req->input('total'));
       $datauser =  User::find(Auth::user()->email);
       if ($datauser->saldo >= $totalpesan) {
            $datauser->saldo  -= $totalpesan;
            $datauser->save();
            DB::table('hjual')->insert(
                [
                    "email_pembeli" => $datauser->email,
                    "total_pembelian" => $totalpesan,
                    "created_at" => Carbon::now()->toDateTimeString()
                ]
            );
            alert("Transaksi Sukses!");
            Cart::where('email', '=', Auth::user()->email)->delete();
            return view('homepage');
       }else{
            alert("Transaksi Gagal,saldo anda tidak cukup!");
            return view('cart');
       }
    }

    public function deletecart(Request $req){
        Cart::where('id_barang','=',$req->delbtn)->where('email', '=', Auth::user()->email)->delete();
        alert("sukses delete!");
        return view('cart');
    }


}
function alert($msg){
    echo "<script>alert('$msg')</script>";
}
