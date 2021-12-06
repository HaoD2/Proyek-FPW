@extends('template.admin.body')

@section('mainSection')
    <section class="py-5 section-1">
        <h2>Request saldo</h2>
        @php
            $req=DB::table('request_saldo')->get();
        @endphp
        <div class="container py-5 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($req as $var)
                        <tr>
                            <td>{{$var->nama_user}}</td>
                            <td>{{$var->jumlah }}</td>
                            <td><form action="/acceptreq" method="get"><button class="btn btn-primary" name="idreq" value="{{$var->id}}" type="submit" style="float: left; margin-right:-50px; margin-left:50px;">Accept</button></form>
                                <form action="/rejectreq" method="get"><button class="btn btn-primary" name="idreq" value="{{$var->id}}" type="submit">Reject</button></form></td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
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
