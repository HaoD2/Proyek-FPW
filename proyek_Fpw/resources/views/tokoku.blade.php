@extends('template.homepage.main')


@section('mainContent')
    @if(Auth::user()->isSeller == 1)
        <div class="box">
            <h1>Toko saya</h1>
            <div>bum saya seller</div>
        </div>
    @else
        <div class="box2">
            <div class="ml-5">
                <div class="mt-5">Akun anda belum diverifikasi menjadi seller</div>
                <button class="btn btn-success">Verifikasi akun saya</button>
            </div>
        </div>
    @endif

@endsection


@section('customStyle')
<style>
.box{
    width:100vw;
    height:400px;
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
</style>
@endsection
