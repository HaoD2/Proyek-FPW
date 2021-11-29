<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Easiest Way to Add Input Masks to Your Forms</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css'); }} ">
</head>
<body>
    <div class="registration-form">

        <form>
            <button type="button" class="btn btn-danger" onclick="location.href='{{ url('/') }}'">Kembali</button>

            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>

            </div>
            <div>
                <span><h1 style="text-align: center">Register</h1></span>

            </div>
            <div class="form-group">
                <input type="text" class="form-control item" placeholder="First Name" style="width: 48%; display: inline" > <input type="text" class="form-control item" id="username" placeholder="Last Name" style="width: 48%; display: inline; float: right">
            </div>
            <div class="form-group">
                <input type="email" class="form-control item" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" placeholder="No. Telepon">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" placeholder="Konfirmasi Password">
            </div>

            <div class="form-group">
                <div>Sudah mempunyai akun? <a href="toLogin">Klik saya</a></div>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-block create-account">Buat Akun</button>
            </div>
        </form>
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
</body>
</html>
