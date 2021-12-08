@extends('template.homepage.main')


@section('mainContent')
@php
    $data = \App\Models\isSeller::where('email', Auth::user()->email)->first();
@endphp
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @if($data != null)
        <div class="box">
            <div style="margin-left: 15px">
                <h1>Loh kan kaka sudah verifikasi ( ◜◒◝ )♡</h1>

            </div>

        </div>
    @else

        <div class="box">
            @php
                RealRashid\SweetAlert\Facades\Alert::info('Verifikasi', 'Tolong masukkan foto KTP beserta selfie bersama KTP untuk melanjutkan verifikasi');
            @endphp
            <div class="ml-5">
                <div style="margin-left: 15px">
                    <form>

                        <h1>Foto KTP</h1>
                        <input type="file" name="" id="ktp" class="btn btn-primary" onchange="encodeKTPFileAsURL(this)"><br><br>
                        <h1>Foto selfie dengan KTP</h1>
                        <input type="file" name="" id="selfie" class="btn btn-primary" onchange="encodeSelfieFileAsURL(this)"> <br><br>

                        <button id="submitVerif" class="btn btn-success submitVerif">Submit</button>
                    </form>

                    <script>


                        var ktp = "";
                            var selfie = "";



                            function encodeKTPFileAsURL(element) {
                                var file = element.files[0];
                                var reader = new FileReader();
                                reader.onloadend = function() {
                                    console.log('RESULT', reader.result)
                                    ktp = reader.result;
                                }
                                reader.readAsDataURL(file);
                                console.log(ktp);
                            }

                            function encodeSelfieFileAsURL(element){
                                var file = element.files[0];
                                var reader = new FileReader();
                                reader.onloadend = function() {
                                    console.log('RESULT', reader.result)
                                    selfie = reader.result;
                                }
                                reader.readAsDataURL(file);
                                console.log(selfie);
                            }
                        $(document).ready(function() {


                            $("#submitVerif").click(function(){
                                $.ajax({
                                    url: "/senddata",
                                    type:"POST",
                                    data:{
                                        ktp64:ktp,
                                        selfie64:selfie,
                                        _token: _token
                                    },
                                    success:function(response){
                                        console.log(response);
                                        if(response) {
                                            console.log(response);
                                        }
                                    },
                                    error: function(error) {
                                        console.log(error);
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

    @endif

@endsection


@section('customStyle')
<style>
.box{
    width:100vw;
    height:600px;
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
