<div class="w-100 position-sticky navbar-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <ul class="list-inline text-secondary">
            <li class="list-inline-item">
                <a href="" class="nav-link text-dark">Customer</a>
            </li>
            <li class="list-inline-item">
            </li>
        </ul>
    </div>
</div>
<nav class="navbar navbar-expand-md position-sticky bg-primary shadow-sm" style="top:0;z-index:2;">
    <div class="row w-100">
        <div class="col-2 col-md-3 d-flex justify-content-center align-items-center">
            <img src="{{ asset('image/icon.png') }}" style="aspect-ratio:1/1;height:50px;" alt="">
            <a class="navbar-brand d-none d-md-block" href="{{ url('/') }}">
                <h2 class="text-head m-0">PLUS-H</h2>
            </a>
        </div>
        <div class="col-8 col-md-6 d-flex align-items-center">
            <form action="" class="w-100">
                <div class="input-group" style="height:35px;">
                    <input type="text" class="form-control rounded-start-pill border-0" placeholder="Cari">
                    <button type="button" class="d-none d-lg-block btn btn-light border-start bg-white" data-bs-toggle="collapse" data-bs-target="#category" aria-expanded="false" aria-controls="category">
                        Kategori <i class="fa-solid fa-caret-down"></i>
                    </button>
                    <a role="button" href="/customer/search" class="btn btn-secondary border-0 rounded-end-circle" id="button-addon1"><i class="fa-solid fa-magnifying-glass"></i></a>
                </div>
            </form>
        </div>
        <div class="col-2 col-md-3 d-flex align-items-center justify-content-end d-md-none">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-12 col-md-3 d-flex align-items-center">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-3 ms-md-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="" title="Notifikasi">
                                <i class="fa-solid fa-bell"></i> <span>Notifikasi</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="accountDropdowm" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdowm">
                                <a class="dropdown-item text-smaller" href="">Pengaturan Akun</a>
                                <a class="dropdown-item text-smaller text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>