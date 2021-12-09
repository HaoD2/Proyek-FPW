@extends('template.admin.body')

@section('mainSection')
    <section class="py-5 section-1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="ml-3">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            @php
                $datauser = \App\Models\VerificationModel::find($data);
            @endphp
            <pre><div><b>Email User:  </b> <div id="email">{{$data}}</div></div></pre>
            <pre><div><b>Foto KTP: </b></div></pre>
            <img src="{{$datauser->foto}}" alt="" width="500px" height="400px">
            <pre><div><b>Foto Selfie: </b></div></pre>
            <img src="{{$datauser->selfie}}" alt="" width="500px" height="400px">
            <br><br>
            <button class="btn btn-success" id="confbtn">Confirm</button>
            <button class="btn btn-danger">Decline</button>

            <script>
                $(document).ready(function(){
                    $('#confbtn').click(function(){
                        var emailuser = $('#email').text();

                        $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $.ajax({
                                    url: "verifyAdmin",
                                    type: "POST",
                                    data: {
                                        status: '1',
                                        email: emailuser
                                    },
                                    success:function(data){
                                        console.log(data);
                                    }
                                })
                    })
                })
            </script>
        </div>
    </section>
@endsection

@section('title')
<title>AdminPage</title>
@endsection

@section('customStyle')
    <style>
        h2{
            text-align: center;
        }
    </style>
@endsection
