<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Navbar scroll</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="/">Home</a></li>
                <li><a class="dropdown-item" href="#">Kategori</a></li>
              @if(Auth::check())
                <li><a class="dropdown-item" href="#">Keranjangku</a></li>
                <li><a class="dropdown-item" href="#">Wishlistku</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/tokoku">Ke toko saya</a></li>
                <li><a class="dropdown-item" href="/setelan">Setelan akun</a></li>
              @endif

            </ul>
          </li>
        </ul>
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll w-50" style="float: left">
            <li class="nav-item w-80" >
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" style="width: 700px; margin-left:20px;" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </li>
        </ul>


        @if (Auth::check())
            @if (Auth::user()->level == "user")
            <div class="fs-5 my-2 me-2">Welcome,{{ Auth::user()->fname}}</div>
            <button class="btn btn-outline-danger" style="margin-left: 50px;" onclick="location.href='{{ url('/log') }}'">Logout</button></form>&nbsp;
            @endif
        @else
            <button class="btn btn-outline-success" onclick="location.href='{{ url('toRegister') }}'">Daftar</button></form> &nbsp;
            <button class="btn btn-outline-success" onclick="location.href='{{ url('toLogin') }}'">Login</button></form>
        @endif
      </div>
    </div>
</nav>

