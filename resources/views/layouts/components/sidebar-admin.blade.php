<nav class="navbar navbar-expand-md sticky-top p-3" style="top:0;box-sizing:border-box;">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="Sidebar">
        <div class="d-flex flex-column align-items-center mb-3">
            <img src="{{ asset('image/profile_pictures/default-user.jpg') }}" alt="" class="w-50 w-md-25 ratio-1x1 border rounded-circle">
            <div class="dropdown">
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
            </div>
        </div>
        <ul class="nav flex-column nav-pills">
            <li class="nav-item">
                <a href="{{ route('admin') }}" class="nav-link h5  {{ $page == 'home' ? 'active' : ''; }}">
                    <strong><i class="fa-solid fa-house me-2"></i>Dashboard</strong>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin') }}" class="nav-link h5 {{ $page == 'shop' ? 'active' : ''; }}">
                    <strong><i class="fa-solid fa-shop me-2"></i>Tentang Toko</strong>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link h5" data-bs-toggle="collapse" data-bs-target="#order" aria-expanded="true" aria-controls="order">
                    <strong><i class="fa-solid fa-list-check me-2"></i>Kelola Pesanan</strong>
                    <i class="position-absolute fa-solid fa-caret-down h5" style="right:35px;"></i>
                </a>
            </li>
            <div id="order" class="accordion-collapse collapse show mb-3 ps-3">
                <li class="nav-item">
                    <a href="/admin/statistic-user {{ $page == 'order' ? 'active' : ''; }}" class="nav-link">Kelola Pesanan</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/statistic-seller {{ $page == 'order.status' ? 'active' : ''; }}" class="nav-link">Status Pengiriman</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/statistic-selling {{ $page == 'order.cancel' ? 'active' : ''; }}" class="nav-link">Pembatalan Pesanan</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/statistic-selling {{ $page == 'order.customer_review' ? 'active' : ''; }}" class="nav-link">Ulasan Pembeli</a>
                </li>
            </div>
            <li class="nav-item">
                <a class="nav-link h5" data-bs-toggle="collapse" data-bs-target="#product" aria-expanded="true" aria-controls="product">
                    <strong><i class="fa-solid fa-list-check me-2"></i>Kelola Produk</strong>
                    <i class="position-absolute fa-solid fa-caret-down h5" style="right:35px;"></i>
                </a>
            </li>
            <div id="product" class="accordion-collapse collapse show mb-3 ps-3">
                <li class="nav-item">
                    <a href="{{ route('admin.product') }}" class="nav-link {{ $page == 'product' ? 'active' : ''; }}">Kelola Produk</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product-archive') }}" class="nav-link {{ $page == 'product.archive' ? 'active' : ''; }}">Arsip Produk</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/statistic-selling" class="nav-link {{ $page == 'product.review' ? 'active' : ''; }}">Ulasan Produk</a>
                </li>
            </div>
            <li class="nav-item">
                <a class="nav-link h5" data-bs-toggle="collapse" data-bs-target="#data" aria-expanded="true" aria-controls="data">
                    <strong><i class="fa-solid fa-database me-2"></i>Data</strong>
                    <i class="position-absolute fa-solid fa-caret-down h5" style="right:35px;"></i>
                </a>
            </li>
            <div id="data" class="accordion-collapse collapse show mb-3 ps-3">
                <li class="nav-item">
                    <a class="nav-link h5" data-bs-toggle="collapse" data-bs-target="#statistic" aria-expanded="true" aria-controls="statistic">
                        <strong><i class="fa-solid fa-list-check me-2"></i>Statistik</strong>
                        <i class="position-absolute fa-solid fa-caret-down h5" style="right:35px;"></i>
                    </a>
                </li>
                <div id="statistic" class="accordion-collapse collapse show mb-3 ps-3">
                    <li class="nav-item">
                        <a href="/admin/statistic-user" class="nav-link">Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/statistic-seller" class="nav-link">Seller</a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/statistic-selling" class="nav-link">Penjualan</a>
                    </li>
                </div>
                <li class="nav-item">
                    <a class="nav-link h5" data-bs-toggle="collapse" data-bs-target="#crud" aria-expanded="true" aria-controls="crud">
                        <strong><i class="fa-solid fa-list-check me-2"></i>Tabel Data</strong>
                        <i class="position-absolute fa-solid fa-caret-down h5" style="right:35px;"></i>
                    </a>
                </li>
                <div id="crud" class="accordion-collapse collapse show mb-3 ps-3">
                    <li class="nav-item">
                        <a href="/admin/statistic-user" class="nav-link">Pengguna</a>
                    </li>
                </div>
            </div>
        </ul>
    </div>
</nav>