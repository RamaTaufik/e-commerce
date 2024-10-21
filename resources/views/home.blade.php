@extends('layouts.app')

@section('title')
Dashboard ● Plus-H
@endsection

@section('content')
<div class="w-100 bg-grad-dark">
    <div class="position-relative w-100" style="height:450px;">
        <img src="{{ asset('image/hero.jpg') }}" alt="" class="w-100 h-100 object-fit-cover">
        <div class="position-absolute d-flex top-0 w-100 h-100 bg-grad-dark align-items-center">
            <h1 class="w-100 display-3 text-center text-white"><strong>Merchant Plushie Terpercaya di Indonesia</strong></h1>
        </div>
    </div>
</div>
<div class="container-fluid bg-light p-5">
    <div class="d-flex justify-content-between align-items-center">
        <h3>Kategori</h3>
    </div>
    <div class="row justify-content-center">
        @foreach ($categories as $category)
        <div class="col-6 col-md-4 col-lg-3 my-2">
            <div class="card position-relative w-100 bg-white text-dark" style="padding-bottom:100%;">
                <div class="position-absolute top-50 start-50 translate-middle w-100 h-100">
                    <img class="card-img object-fit-cover h-100" src="{{ asset('image/categories/'.$category->image_directory) }}">
                </div>
                <div class="card-img-overlay">
                    <h5 class="card-title">{{$category->name}}</h5>
                </div>
                <a href="{{ route('search') }}" class="stretched-link"></a>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="container-fluid bg-light p-md-5 p-2">
    <div class="d-flex justify-content-between align-items-center">
        <h3>Produk Terbaru</h3>
    </div>
    <div class="main-carousel row m-0" data-flickity='{ "contain": true, "groupCells": 3 }'>
        @foreach ($products as $item)
        <div class="col-4 col-md-3 col-lg-2 p-2 mb-3">
            <div class="card border-0 shadow-sm" title="{{$item->name}}">
                <div class="position-relative w-100" style="padding-bottom:100%;">
                    <div class="position-absolute top-50 start-50 translate-middle w-100">
                        <img src="{{ asset('image/products/'.$item['display_image']) }}" class="w-100 rounded" alt="">
                    </div>
                </div>
                <div class="card-body p-2">
                    <h6 class="card-title mb-1 text-dark text-truncate">{{$item->name}}</h6>
                    <p class="card-subtitle text-smaller"><span class="text-warning">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </span> (10)</p>
                    <h5 class="p-0 m-0 mb-2"><b>
                        Rp{{number_format($item->productVariant->min('price'),0,'.',',')}} 
                        @if (count($item->productVariant) > 1) - Rp{{number_format($item->productVariant->max('price'),0,'.',',')}} @endif
                    </b></h5>
                    <p class="m-0 pt-1 mt-1 text-smaller border-top">Terjual 10+</p>
                </div>
                <a href="{{ route('product', $item->id) }}" class="stretched-link"></a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
