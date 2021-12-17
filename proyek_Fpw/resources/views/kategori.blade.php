@extends('template.homepage.main')


@section('mainContent')
    <div class="box">
        <div class="d-flex align-content-stretch flex-wrap">
            @foreach (DB::table('kategori')->get() as $data)
            <button class="btn btn-primary mx-3 my-3" id="{{$data->id}}">{{$data->nama_kategori}}</button>
            @endforeach
        </div>

        <div id="outputdata">


        </div>
    </div>
    <script>

        $(document).ready(function(){

            for (let i = 1; i <= 28; i++) {
                $("#" + i).click(function () {
                    $('#outputdata').text("");
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "getKatData",
                        type: "POST",
                        data: {
                            id:i,
                        },
                        success:function(data){
                            var datas = data["success"];
                            var obj = JSON.parse(datas);
                            console.log(datas);
                            obj.forEach(datak => {
                                $("#outputdata").append(
                                    "<div class=\"card\">" +
                                    "<h4 style=\"text-align: center\">" + datak["nama_barang"]+ "</h4>" +
                                    "<img src=\"{{URL::asset('dummy.png')}}\" style=\"width:90%; height:90%; margin:10px; border-radius:10px;\">" +
                                    "<button class=\"btn btn-success\" style=\"width:250px; margin-left:-6px;\">Add to cart</button>" +
                                    "</div>"
                                );
                            });
                        }
                    })
                })
            }

        })
    </script>
@endsection

@section('customStyle')
<style>

#outputdata{
    /* display:none; */
}

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
    height:100%;
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
