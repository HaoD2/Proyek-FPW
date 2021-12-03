@extends('template.admin.body')

@section('mainSection')
    <section class="py-5 section-1">
        <div class="container py-5 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
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
                                <td><button class="btn btn-danger">Ban</button></td>
                                @else
                                <td><button class="btn btn-primary">Unban</button></td>
                                @endif

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

    </style>
@endsection
