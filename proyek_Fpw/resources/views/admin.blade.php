@extends('template.admin.body')

@section('mainSection')
    <section class="py-5 section-1">
        <h2>List User</h2>
        @php
            $user=DB::table('user')->where('level','=','user')->get();
        @endphp
        <div class="container py-5 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <a href="{{ route('donwload') }}"><button class="btn btn-primary float-right m-3">Convert To Excel</button></a>
                    <form action="{{ route('BanOrUnban') }}">
                        @csrf
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">No telp</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $var)
                          <tr>
                                <td>{{$var->fname . " " . $var->lname}}</td>
                                <td>{{$var->email }}</td>
                                <td>{{$var->notelp}}</td>
                                @if ($var->status == 1)
                                <td><button class="btn btn-danger" type="submit" name="BanOrUnban" value="{{$var->email}}">Ban</button></td>
                                @else
                                <td><button class="btn btn-primary" type="submit" name="BanOrUnban" value="{{$var->email}}">Unban</button></td>
                                @endif
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </form>
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
