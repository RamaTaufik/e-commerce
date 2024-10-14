@extends('layouts.app')

@section('title')
{{$product->name}} ● Plus-H
@endsection

@section('content')

<div class="container-fluid my-4">
    <div class="row">
        <div class="col-12 col-md-9">
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="position-sticky pt-3" style="top:100px;">
                        <div id="productImagesCarousel" class="carousel slide">
                            <div class="carousel-inner" style="height:350px;">
                                <div class="carousel-item active">
                                    <img src="../style/asset/image/test.png" class="d-block w-100 object-fit-cover" style="height:350px;" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../style/asset/image/test.jpg" class="d-block w-100 object-fit-cover" style="height:350px;" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../style/asset/image/test.jfif" class="d-block w-100 object-fit-cover" style="height:350px;" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../style/asset/image/test1.jfif" class="d-block w-100 object-fit-cover" style="height:350px;" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../style/asset/image/test1.jpg" class="d-block w-100 object-fit-cover" style="height:350px;" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="button" data-bs-target="#productImagesCarousel" data-bs-slide-to="0" class="btn" aria-current="true" aria-label="Slide 1">
                                <img src="../style/asset/image/test.png" class="d-block object-fit-cover" style="aspect-ratio:1/1;height:50px;" alt="...">
                            </button>
                            <button type="button" data-bs-target="#productImagesCarousel" data-bs-slide-to="1" class="btn" aria-label="Slide 2">
                                <img src="../style/asset/image/test.jpg" class="d-block object-fit-cover" style="aspect-ratio:1/1;height:50px;" alt="...">
                            </button>
                            <button type="button" data-bs-target="#productImagesCarousel" data-bs-slide-to="2" class="btn" aria-label="Slide 3">
                                <img src="../style/asset/image/test.jfif" class="d-block object-fit-cover" style="aspect-ratio:1/1;height:50px;" alt="...">
                            </button>
                            <button type="button" data-bs-target="#productImagesCarousel" data-bs-slide-to="3" class="btn" aria-label="Slide 4">
                                <img src="../style/asset/image/test1.jfif" class="d-block object-fit-cover" style="aspect-ratio:1/1;height:50px;" alt="...">
                            </button>
                            <button type="button" data-bs-target="#productImagesCarousel" data-bs-slide-to="4" class="btn" aria-label="Slide 5">
                                <img src="../style/asset/image/test1.jpg" class="d-block object-fit-cover" style="aspect-ratio:1/1;height:50px;" alt="...">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7 px-5">
                    <div class="position-sticky border-bottom bg-light pt-3 mb-3" style="top:100px;z-index:1;">
                        <h3 class="text-head">Tipis-tipis abangku, menyala, tetap ilmu padi king</h3>
                        <p class="card-subtitle mb-2 h6"><span class="text-warning">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </span> (10 ulasan) <span class="mx-2">•</span> Terjual 10+</p>
                        <h6 class="">di <span><a href="/customer/search" class="text-dark"><strong>Kategori</strong></a></span></h6>
                        <h4 class="text-end"><strong>Rp405.000,00</strong></h4>
                    </div>
                    <h6><strong>Deskripsi Produk</strong></h6>
                    <dl class="row">
                        <dd class="col-2 text-head">Bahan</dd>
                        <dd class="col-10">Besi</dd>
                        <dd class="col-2 text-head">Ukuran</dd>
                        <dd class="col-10">15 cm</dd>
                        <dd class="col-2 text-head">Berat</dd>
                        <dd class="col-10">119 gram</dd>
                    </dl>
                    <p>
                        tipis tipis abangkuh 🔥🔥<br>
                        sesekali 🙌🏼<br>
                        kelas abangkuh 🔥🔝<br>
                        izin abangkuh 🔥<br>
                        panutan 🔝✊🏼🙌🏼<br>
                        kelas abangda 🔥🫡<br>
                        rispeekk 👍🏼🙌🏼<br>
                        manyala ilmu padi 🌾<br>
                        kelas boskuuuh 🔥👍🏼<br>
                        kalau diatas jgn lupa merunduk<br>
                        tetep ilmu padi 🌾🌾<br>
                        kasih paham tipis tipis 🤝🏼<br>
                        top abangku 👍🏼👍🏼<br>
                        eh yg punya setengah indo nih ee 😜😜<br>
                        kelas banget kanda 🙏🏼🕺🏻<br>
                        manyala capt 🔥🔥<br>
                        abang idola panutan ini 😘😘<br>
                        top 🔝<br>
                        jangan kasih kendor ee 🕺🏻🕺🏻<br>
                        idola 🙌🏼🙌🏼<br>
                        capt idolaa 🔥🙌🏼🔝<br>
                        kasih paham capt 🔥💯🙌🏼<br>
                        apotik tutup captain 🔥🔥💯🔝<br>
                        lanjutkan abangkuuhh 🔥🔝💥<br>
                        jangan kasi longgar king 🔝💯🔥🙌🏼<br>
                        eitsss pondasi bangsa abangkuuhh 🔥🔝🙌🏼</p>
                </div>
                <div class="col-12">
                    <div class="accordion accordion-custom" id="productInfo">
                        <a class="accordion-btn" role="button" data-bs-toggle="collapse" href="#reviews" aria-expanded="true" aria-controls="reviews">
                            Ulasan
                        </a>
                        <a class="accordion-btn collapsed" role="button" data-bs-toggle="collapse" href="#moreInformations" aria-expanded="false" aria-controls="moreInformations">
                            Informasi Tambahan
                        </a>
                        <div class="accordion-item">
                            <div id="reviews" class="accordion-collapse collapse show" data-bs-parent="#productInfo">
                                <div class="accordion-body">
                                    <div class="position-relative bg-white mb-2 p-2 shadow">
                                        <h4 class="position-absolute" style="top:20px;right:20px;"><sup class="float-end"><i class="fa-solid fa-ellipsis-vertical"></i></sup></h4>
                                        <div class="d-flex align-items-center">
                                            <img src="../style/asset/image/icon.jpg" alt="" class="rounded-circle" style="aspect-ratio:1/1;height:35px;">
                                            <div class="ms-2">
                                                <p class="text-smaller m-0"><strong><a href="/customer/other-account" class="text-dark text-decoration-none">Pengguna Lain</a></strong></p>
                                                <p class="text-smaller m-0 text-warning">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <p class="m-0 p-0">Sekarang dah tukar jadi hitam, mantap!</p>
                                    </div>
                                </div>
                            </div>
                            <div id="moreInformations" class="accordion-collapse collapse" data-bs-parent="#productInfo">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="position-sticky" style="top:100px;">
                <div class="card border-0 p-3 shadow-sm">
                    <form method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-2">
                            @if(count($productVariant) > 1)
                            <p class="form-label m-0">Variasi</p>
                                @foreach ($productVariant as $variant)
                                <input type="radio" class="btn-check" name="code" id="{{$variant->product_variant_code}}" value="{{$variant->product_variant_code}}" 
                                 onclick="changeStock({{json_encode($variant->stock)}})" autocomplete="off">
                                <label class="btn btn-secondary" for="{{$variant->product_variant_code}}">{{$variant->variation}}</label>
                                @endforeach
                            @else
                            <input type="hidden" name="code" value="{{$productVariant[0]->product_variant_code}}">
                            @endif
                        </div>
                        <div class="d-flex justify-content-between">
                            <label for="qty" class="form-label m-0">Jumlah Beli</label>
                            <p class="text-warning text-head m-0">
                                Sisa stok : 
                                <span id="stock">@if(count($productVariant) > 1) - @else {{$productVariant[0]->stock}} @endif</span>
                            </p>
                        </div>
                        <input type="number" name="qty" id="qty" class="form-control">
                        <div class="form-text my-2"><a href="" class="text-decoration-none text-secondary"><i class="fa-solid fa-pencil"></i> Tambah catatan</a></div>
                        <div class="d-flex justify-content-between text-head">
                            <h6>Subtotal</h6><h6 class="text-secondary">Rp405.000,00</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <input type="submit" formaction="{{ route('cart.add') }}" class="btn btn-primary w-50" value="Tambah">
                            <input type="submit" formaction="{{ route('cart.add', ['buy' => true]) }}" class="btn btn-secondary w-50" value="Beli">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('script/variant.js') }}"></script>
@endsection