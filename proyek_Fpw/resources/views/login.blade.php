<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css'); }} ">

</head>
<body>
    <div class="registration-form">
        <form action="{{route('login')}}" method="GET">
            @csrf
            <button type="button" class="btn btn-danger" onclick="location.href='{{ url('/') }}'">Kembali</button>

            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>

            </div>
            <div>
                <span><h1 style="text-align: center">Login</h1></span>

            </div>

            <div class="form-group">
                <input type="text" class="form-control item" name="email" id="email" placeholder="email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" name="password" id="password" placeholder="password">
            </div>
            <div class="form-group">
                <button class="btn btn-block create-account" type="submit">Login</button>
            </div>
            <div class="form-group">
                <div>Tidak mempunyai akun? <a href="toRegister">Klik saya</a></div>
            </div>

        </form>

        <script>

        </script>
        {{-- <div class="social-media">
            <h5>Sign up with social media</h5>
            <div class="social-icons">
                <a href="#"><i class="icon-social-facebook" title="Facebook"></i></a>
                <a href="#"><i class="icon-social-google" title="Google"></i></a>
                <a href="#"><i class="icon-social-twitter" title="Twitter"></i></a>
            </div>
        </div> --}}
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
</body>
</html>
