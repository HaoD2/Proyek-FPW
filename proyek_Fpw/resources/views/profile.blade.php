@extends('template.homepage.main')


@section('mainContent')
<div class="box">
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white" style="float:left">
        <div class="position-sticky">
          <div class="list-group list-group-flush mt-1">
            <a href="#" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true">
              <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Profil saya</span>
            </a>
            <a href="{{route('goto_keamanan')}}" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Keamanan</span>
            </a>
            <a href="/goto_riwayat" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Riwayat Pembelian saya</span>
            </a>
          </div>
        </div>
    </nav>
    <div class="container1">
        <h3><img src="dummy.png" alt="Avatar" class="avatar"><br>{{Auth::user()->fname}}&nbsp;{{Auth::user()->lname}}</h3>
        <br>
        <pre><p> <strong>Full Name :</strong>                 {{Auth::user()->fname." ".Auth::user()->lname}}</p></pre>
        <pre><p> <strong>Email :</strong>                     {{Auth::user()->email}}</p></pre>
        <pre><p> <strong>Nomor Telepon :</strong>             {{Auth::user()->notelp}}</p></pre>
        <form action="/topup" method="get"><pre><p> <strong>Saldo :</strong>                     {{"Rp.".Auth::user()->saldo}}   <button>Top Up</button></p></pre></form>
    </div>
</div>

@endsection


@section('customStyle')
<style>
.box{
    width:100vw;
    height:500px;
    background-color: white;
    padding: 10px;
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
