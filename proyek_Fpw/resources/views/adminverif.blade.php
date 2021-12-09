@extends('template.admin.body')

@section('mainSection')
<section class="py-5 section-1">
    <div class="ml-3">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach (\App\Models\VerificationModel::all() as $data)
                    <tr>
                        <form action="adminconfirmver" method="get">
                            <th>{{$data->email}}</th>
                            <th> <button type="submit" value="{{$data->email}}" name="checkBtn">Check</button></th>
                        </form>

                    </tr>
                @endforeach


            </tbody>
          </table>
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
