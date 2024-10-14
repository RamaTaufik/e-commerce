@extends('layouts.app')

@section('title')
Dashboard ● Plus-H
@endsection

@section('content')
<div class="container-fluid bg-grad-dark">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-light p-5">
    <div class="row">
        <div class="col-3 d-none d-md-flex flex-column justify-content-evenly p-3 bg-white shadow">
            <div class="row pb-1">
                <div class="col-2 d-flex justify-content-center align-items-center"><i class="fa-solid fa-bars"></i></div>
                <div class="col-10 h6 m-0"><b>Telusuri Kategori</b></div>
            </div>
            @foreach ($category as $c)
            <div class="row">
                <div class="col-2 d-flex justify-content-center align-items-center"><i class="fa-solid fa-palette"></i></div>
                <div class="col-10"><a href="" class="text-decoration-none text-dark">{{$c->name}}</a></div>
            </div>
            @endforeach
        </div>
        <div class="col-12 col-md-9">
            <img src="{{ asset('image/jumbotron.png') }}" class="object-fit-cover w-100" alt="">
        </div>
    </div>
</div>
<div class="container-fluid bg-light p-md-5 p-2">
    <div class="d-flex justify-content-between align-items-center">
        <h3>Produk Terbaru</h3>
    </div>
    <div class="main-carousel row" data-flickity='{ "contain": true, "groupCells": 3 }'>
        @foreach ($product as $item)
        <div class="col-4 col-md-3 col-lg-2 p-2 mb-3">
            <div class="card border-0 shadow-sm" title="{{$item->name}}">
                <img src="{{ asset('image/products/'.$item['display_image']) }}" class="object-fit-cover img-fluid ratio-1x1 rounded" alt="">
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
                        Rp{{number_format($item->price,0,'.',',')}} 
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
