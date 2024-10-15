@extends('layouts.app-admin', ['page' => 'product.archive'])

@section('title')
Edit "{{$product->name}}" ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Product / Archive / Edit</h6>
<h1>Edit Produk</h1>
<div class="container fluid">
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="addModalLabel">Tambah Varian Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.product_variant-create') }}" class="mb-4" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="variation">{{ __('Nama Variasi') }}</label>
                                <input id="variation" type="text" class="form-control @error('variation') is-invalid @enderror" name="variation" value="{{ old('variation') }}" required autocomplete="variaiton" autofocus>
                                @error('variation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="stock">{{ __('Stok') }}</label>
                                <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" required autocomplete="stock" autofocus>
                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-5">
                                <label for="image[]">{{ __('Gambar (min. 1, max. 5)') }}</label>
                                <input id="image[]" type="file" class="form-control @error('image[]') is_invalid @enderror" name="image[]" required>
                                @error('image[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Tambah') }}
                            </button>
                            <button type="button" class="ms-2 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-2 border">
        <form action="{{ route('admin.product-update', $product->id) }}" method="POST" class="mb-3">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="name">{{ __('Nama Produk') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="category_code">{{ __('Kategori') }}</label>
                    <select id="category_code" class="form-select @error('category_code') is-invalid @enderror" name="category_code" value="{{ old('category_code') }}" required autocomplete="category_code" autofocus>
                        @foreach ($category as $c)
                        <option value="{{$c->category_code}}"<?php if($c->category_code == $product->category_code) { echo "selected"; } ?>>{{$c->category_code}} / {{$c->name}}</option>
                        @endforeach
                    </select>
                    @error('category_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label for="description">{{ __('Deskripsi Produk') }}</label>
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ $product->description }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label for="weight_in_gram">{{ __('Berat (gram)') }}</label>
                    <input id="weight_in_gram" type="number" class="form-control @error('weight_in_gram') is-invalid @enderror" name="weight_in_gram" placeholder="Berat" value="{{ $product->weight_in_gram }}" required autocomplete="weight_in_gram" autofocus>
                    @error('size_in_cm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <div class="input-group">
                        <input id="h" type="number" class="form-control @error('h') is-invalid @enderror" name="h" placeholder="Panjang" value="{{ $product->h }}" required autocomplete="h" autofocus>
                        <input id="w" type="number" class="form-control @error('w') is-invalid @enderror" name="w" placeholder="Lebar" value="{{ $product->w }}" required autocomplete="w" autofocus>
                        <input id="t" type="number" class="form-control @error('t') is-invalid @enderror" name="t" placeholder="Tinggi" value="{{ $product->t }}" required autocomplete="t" autofocus>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label for="material">{{ __('Material') }}</label>
                    <input id="material" type="text" class="form-control @error('material') is-invalid @enderror" name="material" value="{{ $product->material }}" required autocomplete="material" autofocus>
                    @error('material')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label for="price">{{ __('Harga') }}</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required autocomplete="price" autofocus>
                    </div>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ubah</button>
            <a class="btn btn-secondary" data-bs-toggle="modal" href="#addModal"><i class="fa-solid fa-plus"></i> Tambah varian</a>
        </form>
        <div class="variant-list row">
            @foreach ($productVariant as $variant)
            <div class="col-6 col-lg-4 mb-2">
                <div class="variant-item bg-primary">
                    <h3 class="m-0">{{$variant['variation']}}</h3>
                    <p class="m-0 p-0 fs-3">{{$variant['stock']}}</p>
                    <a class="stretched-link" data-bs-toggle="modal" href="#addModal"></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // function edit($product, $color) {}
</script>
@endsection