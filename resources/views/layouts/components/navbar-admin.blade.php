<nav class="navbar navbar-expand-md position-sticky bg-primary shadow-sm" style="top:0;z-index:2;">
    <div class="row w-100">
        <div class="col-4 col-md-6 d-flex justify-content-start align-items-center">
            <button class="navbar-toggler ms-3 d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <img src="{{ asset('image/icon.png') }}" class="ms-3 ratio-1x1" style="height:50px;" alt="">
            <a class="navbar-brand d-none d-md-block" href="{{ url('/admin') }}">
                <h2 class="text-head m-0">PLUS-H</h2>
            </a>
        </div>
        <div class="col-8 col-md-6 d-flex align-items-center justify-content-end">
            <ul class="navbar-nav ms-3 ms-md-auto">
                <!-- Authentication Links -->
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" href="#notification" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Notifikasi">
                        <i class="fa-solid fa-bell"></i> <span>Notifikasi</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" id="notification" style="width:250px;max-height:300px;">
                        <li class="dropdown-item">
                            <div class="row">
                                <div class="col-2">
                                    <img src="../style/asset/image/icon.jpg" alt="" class="rounded-circle" style="aspect-ratio:1/1;width:35px;">
                                </div>
                                <div class="col-10">
                                    <p class="m-0 p-0 text-smaller text-truncate">
                                        Crazy? I was crazy once. They locked me in a room, a rubber room. A rubber room with rats. Rats make me crazy.
                                    </p>
                                    <p class="m-0 p-0 text-smaller text-monospace">12:34</p>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-item border-top read">
                            <div class="row">
                                <div class="col-2">
                                    <img src="../style/asset/image/icon.jpg" alt="" class="rounded-circle" style="aspect-ratio:1/1;width:35px;">
                                </div>
                                <div class="col-10">
                                    <p class="m-0 p-0 text-smaller text-truncate">
                                        Crazy? I was crazy once. They locked me in a room, a rubber room. A rubber room with rats. Rats make me crazy.
                                    </p>
                                    <p class="m-0 p-0 text-smaller text-monospace">12:34</p>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-item border-top">
                            <div class="row">
                                <div class="col-2">
                                    <img src="../style/asset/image/icon.jpg" alt="" class="rounded-circle" style="aspect-ratio:1/1;width:35px;">
                                </div>
                                <div class="col-10">
                                    <p class="m-0 p-0 text-smaller text-truncate">
                                        Crazy? I was crazy once. They locked me in a room, a rubber room. A rubber room with rats. Rats make me crazy.
                                    </p>
                                    <p class="m-0 p-0 text-smaller text-monospace">12:34</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>