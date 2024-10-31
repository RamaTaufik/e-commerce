@extends('layouts.app')

@section('title')
{{$product->name}} ● Plus-H
@endsection

@section('content')

<div class="container-fluid my-4">
    <div class="row">
        <div class="col-12 col-md-9">
            <a class="mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('home') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="position-sticky pt-3" style="top:100px;">
                        <div id="productImagesCarousel" class="carousel slide">
                            <div class="carousel-inner" style="height:350px;">
                                @foreach ($productPictures as $picture)
                                <div class="carousel-item @if ($loop->iteration = 1) active @endif">
                                    <img src="{{ asset('image/products/'.$picture->directory) }}" class="mx-auto img-fluid object-fit-cover" style="height:350px;" alt="...">
                                </div>
                                @endforeach
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
                            @foreach ($productPictures as $picture)
                            <button type="button" data-bs-target="#productImagesCarousel" data-bs-slide-to="{{$loop->iteration - 1}}" class="btn" aria-current="true" aria-label="Slide 1">
                                <img src="{{ asset('image/products/'.$picture->directory) }}" class="d-block object-fit-cover" style="aspect-ratio:1/1;height:50px;" alt="...">
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7 p-5 bg-light">
                    <div class="position-sticky bg-light border-bottom mb-3" style="top:100px;z-index:1;">
                        <h3 class="text-head">{{$product->name}}</h3>
                        <p class="card-subtitle mb-2 h6"><span class="text-warning">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </span> ({{$product['rating_amount']}} ulasan) <span class="mx-2">•</span> Terjual {{$product['sold']}}</p>
                        <h6 class="">di <span><a href="/customer/search" class="text-dark"><strong>{{$product->category->name}}</strong></a></span></h6>
                        <h4 class="text-end"><strong id="price">Rp{{number_format($productVariants->first()->price,0,',','.')}}</strong></h4>
                    </div>
                    <h6><strong>Deskripsi Produk</strong></h6>
                    <dl class="row">
                        <dd class="col-2 text-head">Bahan</dd>
                        <dd class="col-10">{{$product->material}}</dd>
                        <dd class="col-2 text-head">Ukuran</dd>
                        <dd class="col-10" id="size">{{str_replace('-',' cm x ',$productVariants->first()->size_in_cm).' cm'}}</dd>
                        <dd class="col-2 text-head">Berat</dd>
                        <dd class="col-10" id="weight">{{$productVariants->first()->weight_in_gram}} gram</dd>
                    </dl>
                    <p>{{$product->description}}</p>
                </div>
                <div class="col-12">
                    <div class="accordion nav-tabs" id="productInfo">
                        <a class="d-inline nav-link active" role="button" data-bs-toggle="collapse" href="#reviews" aria-expanded="true" aria-controls="reviews">
                            Ulasan
                        </a>
                        <a class="d-inline nav-link collapsed" role="button" data-bs-toggle="collapse" href="#moreInformations" aria-expanded="false" aria-controls="moreInformations">
                            Informasi Tambahan
                        </a>
                        <div class="bg-white">
                            <div id="reviews" class="accordion-collapse collapse show" data-bs-parent="#productInfo">
                                <div class="accordion-body">
                                    @foreach ($reviews as $review)
                                    <div class="position-relative bg-white mb-2 p-2 shadow">
                                        {{-- <h4 class="position-absolute" style="top:20px;right:20px;"><sup class="float-end"><i class="fa-solid fa-ellipsis-vertical"></i></sup></h4> --}}
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('image/profile_pictures/default-user.jpg') }}" alt="" class="rounded-circle" style="aspect-ratio:1/1;height:35px;">
                                            <div class="ms-2">
                                                <p class="text-smaller m-0"><strong>{{$review->orderItem->order->customer->first_name}}</strong></p>
                                                <div class="d-flex text-warning" style="width:200px;">
                                                    <div class="overflow-x-hidden" style="width:20%;"><i class="fa-solid fa-star"></i></div>
                                                    <div class="overflow-x-hidden" style="width:20%;"><i class="fa-solid fa-star"></i></div>
                                                    <div class="overflow-x-hidden" style="width:20%;"><i class="fa-solid fa-star"></i></div>
                                                    <div class="overflow-x-hidden" style="width:20%;"><i class="fa-solid fa-star"></i></div>
                                                    <div class="overflow-x-hidden" style="width:20%;"><i class="fa-solid fa-star"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <img src="{{ asset('image/reviews/'.$review->picture) }}" alt="" class="img-fluid object-fit-cover" style="height:120px;">
                                            <p class="m-0 p-0">{{$review->customer_review}}</p>
                                        </div>
                                    </div>
                                    @endforeach
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
                            @if(count($productVariants) > 1)
                            <p class="form-label m-0">Variasi</p>
                                @foreach ($productVariants as $variant)
                                <input type="radio" class="btn-check" name="code" id="{{$variant->product_variant_code}}" value="{{$variant->product_variant_code}}" 
                                 onclick="changeVariant(this,{{json_encode($variant)}})" autocomplete="off">
                                <label class="btn @if ($loop->first) btn-primary @else btn-secondary @endif variant-label" id="label-{{$variant->product_variant_code}}" for="{{$variant->product_variant_code}}">
                                    {{$variant->variation}}
                                </label>
                                @endforeach
                            @else
                            <input type="hidden" name="code" value="{{$productVariants[0]->product_variant_code}}">
                            @endif
                        </div>
                        <div class="d-flex justify-content-between">
                            <label for="qty" class="form-label m-0">Jumlah Beli</label>
                            <p class="text-warning text-head m-0">
                                Sisa stok : 
                                <span id="stock">{{$productVariants[0]->stock}}</span>
                            </p>
                        </div>
                        <input type="number" name="qty" id="qty" class="form-control">
                        <div class="form-text my-2"><a href="" class="text-decoration-none text-secondary"><i class="fa-solid fa-pencil"></i> Tambah catatan</a></div>
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