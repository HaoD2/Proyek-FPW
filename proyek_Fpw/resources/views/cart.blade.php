@extends('template.homepage.main')


@section('mainContent')

<div class="box">
<table class="table">
        <form action="{{route('bayar')}}" method="GET">
        <table class="table table-striped" id="itemtable">
            <thead>
              <tr>
                <th scope="col">Barang</th>
                <th scope="col">Nama barang</th>
                <th scope="col">Jumlah</th>
                <th scope ="col">Harga per Barang</th>
                <th scope ="col">Total harga/jenis</th>
              </tr>
            </thead>
            <tbody>

                @php
                    $cartdata = DB::table('cart')->where('email', '=', Auth::user()->email)->get();
                    $ctr = 0;

                @endphp

                @foreach ($cartdata as $data)
                @php
                    $ctr++;
                    $databarang = DB::table('barang')->where('id', '=', $data->id_barang)->first();
                @endphp
                <tr>
                    <th scope="row">
                        <div class="card">
                            <img src="{{URL::asset('dummy.png')}}" style="width:90%; height:90%; margin:10px; border-radius:10px;">
                        </div>
                    </th>
                    <td>{{$databarang->nama_barang}}</td>
                    <td><input type="number" id="inp" style="width: 100px" min="1" max="99" value="1"><input type="hidden" name="" id="" value="{{$ctr}}"></td>
                    <td><span>Rp.</span>  <span id="pp{{$ctr}}">{{$databarang->harga}}</span></td>
                    <td><span>Rp.</span>  <span id="total{{$ctr}}">{{$databarang->harga}}</span></td>

                  </tr>

                @endforeach
                <br>
                <div id="counterrr" style="display: none">{{$ctr}}</div>
                <script>

                    $(document).ready(function(){
                        var text= "";
                        var subtotal = 0;
                        for (let i = 1; i <= parseInt($("#counterrr").text()); i++) {
                            var temp2 = parseInt($("#total"+i).text());
                            subtotal += temp2;
                        }
                        $("#subtotal").text(subtotal);
                        $("#totalharga").val(subtotal);

                            $('tbody').on('input','#inp',function() {
                                var idx = $(this).siblings('input:hidden').val();
                                var total = parseInt($(this).val()) * parseInt($("#pp" + (idx)).text());
                                $("#total" + (idx)).text(total);
                                var temp = parseInt($("#counterrr").text());
                                var subtotal = 0;

                                for (let i = 1; i <= temp; i++) {
                                    var temp2 = parseInt($("#total"+i).text());
                                    subtotal += temp2;
                                }
                                $("#subtotal").text(subtotal);
                                $("#totalharga").val(subtotal);
                            });



                    })
                </script>
            </tbody>
          </table>
          <div style="float: right"><span>Rp.</span><span id="subtotal"></span> <input type="hidden" name="total" id="totalharga"></div>
          <br>
          <div style="float: right"><button class="btn btn-success">Bayar</button></div> <br><br>
        </form>
    </div>



@endsection

@section('customStyle')
<style>

body{
    background-color: #fff;
}
input[type=number], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.submit{
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.submit:hover {
  background-color: #45a049;
}


.box{
    width:100vw;
    height:100%;
    background-color: white;
    padding: 40px;
    border-bottom-left-radius: 75px;
    border-bottom-right-radius: 75px;
}

button{
    border: 1px solid black;
}

.avatar {
  vertical-align: middle;
  width: 150px;
  height: 150px;
  border-radius: 50%;
}
h3{
    text-align: center;
}

.container1{
    margin:0 auto;
    background-color: whitesmoke;
}

p{
    font-size: 16px;
    border-bottom: 1px solid lightgray;
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

.container {
    margin-top:30px;
    border-radius: 10px;
    background-color:teal;
    width:100%;
    height:20vw;
    padding: 20px;
}

a {
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

body {
  background-color: #fbfbfb;
}


/* Sidebar */
.sidebar {
  position: relative;
  top: 0;
  bottom: 0;
  left: 0;
  width: 240px;
  z-index: 600;
  height: 450px;
  border-right: 1px solid gray;
}

@media (max-width: 991.98px) {
  .sidebar {
    width: 100%;
  }
}
.sidebar .active {
  border-radius: 5px;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}
</style>
@endsection
