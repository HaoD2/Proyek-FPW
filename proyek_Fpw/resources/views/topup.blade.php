@extends('template.homepage.main')


@section('mainContent')
<div class="box">
<form action="/isisaldo" method="GET">
    <label for="via">Top Up:</label>
    <select id="via" name="via">
        <option value="GOPAY">GoPay</option>
        <option value="BCA">BCA</option>
        <option value="OVO">Ovo</option>
    </select>
    <br>
    <br>
    <label for="jumlah">Jumlah :</label>
    <input type="number" name="jumlah" placeholder="Jumlah...">
    <input type="submit" value="Submit" class="submit">
</form>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="assets/js/script.js"></script>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@endsection


@section('customStyle')
<style>
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
    height:400px;
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
