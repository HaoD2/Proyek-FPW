@extends('template.homepage.main')
@section('mainContent')
<script src="assets/js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    @php
        $data = \App\Models\isSeller::where('email', Auth::user()->email)->first();
        $kategori=DB::table('kategori')->get();
    @endphp
    @if($data != null)
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="w3-sidebar w3-bar-block w3-white" style="width:130px; height: 100%">
        <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'Input')">Input barang</button>
        <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'Left')">Lihat barang</button>
    </div>
    <div style="margin-left:130px; background-color: #fff;height: 100%;">
        <div id="Input" class="w3-container shop w3-animate-opacity" style="display:none">
            <div class="containerbox">
                <h3><img src="{{URL::asset("image/shop.png");}}" style="width:70px; height:50px;">&nbsp;Input Barang</h3>
                <br>
                <form action="/inputbarang" method="get">
                    <input type="text"  name="nama_barang" placeholder="Nama Barang" id="namabarang"><br>
                    <textarea rows="4" cols="145" name="deskripsi" placeholder="Deskripsi barang" id="deskripsi"></textarea>
                    <input type="number" name="harga" placeholder="Harga" id="harga"><br>
                    <select name="kategori" id="kategori">
                        @foreach ($kategori as $kategori)
                            <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
        <div id="Left" class="w3-container shop w3-animate-left" style="display:none">
            <h3 style="margin: 20px;"><img src="{{URL::asset("image/shop.png");}}" style="width:70px; height:50px;">&nbsp;Lihat Barang</h3>
            <div class="containerbox">
                @php
                    $barang=DB::table('barang')->get();
                @endphp
                <table class="table1">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                    </tr>
                    @foreach ($barang as $barang)
                        @if ($barang->email_penjual==Auth::user()->email)
                        <tr>
                            <td>{{$barang->nama_barang}}</td>
                            <td>{{$barang->kategori_barang}}</td>
                            <td>{{$barang->deskripsi}}</td>
                            <td>{{$barang->harga}}</td>
                        </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @else
        <div class="box2">
            <div class="ml-5">
                <div class="mt-5">Akun anda belum diverifikasi menjadi seller</div>
                <button class="btn btn-success" onclick="location.href='{{ url('verifikasi') }}'">Verifikasi akun saya</button>
            </div>
        </div>
    @endif
<script>
    function openLink(evt, animName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("shop");
        for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
        }
        document.getElementById(animName).style.display = "block";
        evt.currentTarget.className += " w3-red";
    }



</script>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

@endsection
@section('customStyle')
<style>
.table1 {
    font-family: sans-serif;
    color: #444;
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #f2f5f7;
}

.table1 tr th{
    background: #35A9DB;
    color: #fff;
    font-weight: normal;
}

.table1, th, td {
    padding: 8px 30px;
    text-align: center;
}

.table1 tr:hover {
    background-color: #f5f5f5;
}

.table1 tr:nth-child(even) {
    background-color: #f2f2f2;
}


input[type=text], select {
  width: 99%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

textarea{
  width: 99%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=number], select {
  width: 99%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 99%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.box{
    width:100vw;
    height:0px;
    background-color: white;
    padding: 10px;
    border-bottom-left-radius: 75px;
    border-bottom-right-radius: 75px;
}

.box2{
    width:100vw;
    height:200px;
    background-color: white;
    padding: 10px;
    border-bottom-left-radius: 75px;
    border-bottom-right-radius: 75px;
}

.card{
    width:250px;
    height:300px;
    background-color: white;
    padding: 5px;
    margin:20px;
    margin-left: 32px;
    float: left;
}

.main{
    width:90%;
    margin:0 auto;
    margin-top:200px;
    height: auto;
}

h2{
    border-bottom:1px solid gray;
}

.containerbox {
  width:80%;
  border-radius: 5px;
  padding: 30px;
}

.container {
    margin-top:30px;
    border-radius: 10px;
    background-color:teal;
    width:100%;
    height:20vw;
    padding: 20px;
}

a{
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a:hover {
  background-color: #ddd;
  color: black;
}

.previous {
  margin-top:7vw;
  background-color: #f1f1f1;
  position: absolute;
  font-weight: 900;
  color: black;
}

.next {
  margin-top:7vw;
  float: right;
  background-color: #f1f1f1;
  font-weight: 900;
  color: black;
}

.round {
  border-radius: 50%;
}

@media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
}
</style>
@endsection
