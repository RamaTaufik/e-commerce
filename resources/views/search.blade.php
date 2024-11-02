@extends('layouts.app')

@section('title')
Cari "{{$filter['index']}}" ● Plus-H
@endsection

@section('search-index')
{{$filter['index']}}
@endsection

@section('content')
<div class="container-fluid p-md-5 p-2">
    <div class="row">
        <div class="col-12 col-md-3 position-sticky">
            <form action="search" method="get">
                @csrf
                <label for="categorySelect" class="form-label">Kategori</label>
                <select name="category_code" id="categorySelect" class="form-select mb-3">
                    @foreach ($categories as $category)
                    <option value="{{$category->category_code}}" @if($category->category_code == $filter['category']) selected @endif>
                        {{$category->name}}
                    </option>
                    @endforeach
                </select>
                <label class="form-label">Rentang Harga</label>
                <div class="input-group">
                    <input type="number" name="minPrice" class="form-control" value="{{$filter['minPrice']}}">
                    <span class="input-group-text"> - </span>
                    <input type="number" name="maxPrice" class="form-control" value="{{$filter['maxPrice']}}">
                </div>
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
                @method('GET')
            </form>
        </div>
        <div class="col-12 col-md-9">
            <div class="row">
                @foreach ($product as $item)
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
                            </span> ({{$item['rating_amount']}})</p>
                            <h5 class="p-0 m-0 mb-2"><b>
                                Rp{{number_format($item->productVariant->min('price'),0,'.',',')}} 
                                @if (count($item->productVariant) > 1) - Rp{{number_format($item->productVariant->max('price'),0,'.',',')}} @endif
                            </b></h5>
                            <p class="m-0 pt-1 mt-1 text-smaller border-top">Terjual {{$item['sold']}}</p>
                        </div>
                        <a href="{{ route('product', $item->id) }}" class="stretched-link"></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
