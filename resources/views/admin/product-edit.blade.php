@extends('layouts.app-admin', ['page' => 'product.archive'])

@section('title')
Edit Produk ● Plus-H ADMIN
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
                    <form action="{{ route('register') }}" class="mb-4" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-1">
                                <label for="size(cm)">{{ __('Ukuran (cm)') }}</label>
                                <select id="size(cm)" class="form-select @error('size(cm)') is-invalid @enderror" name="size(cm)" value="{{ old('size(cm)') }}" required autocomplete="size(cm)" autofocus>
                                    <option value="sm" title="Small">SM</option>
                                    <option value="md" title="Medium">MD</option>
                                    <option value="lg" title="Large">LG</option>
                                    <option value="xl" title="Extra Large">XL</option>
                                </select>
                                @error('size(cm)')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6 mb-1">
                                <label for="weight(g)">{{ __('Berat (gram)') }}</label>
                                <input id="weight(g)" type="number" class="form-control @error('weight(g)') is-invalid @enderror" name="weight(g)" placeholder="Berat" value="{{ old('weight(g)') }}" required autocomplete="weight(g)" autofocus>
                                @error('size(cm)')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <div class="input-group">
                                    <input id="h" type="number" class="form-control @error('h') is-invalid @enderror" name="h" placeholder="Panjang" value="{{ old('h') }}" required autocomplete="h" autofocus>
                                    <input id="w" type="number" class="form-control @error('w') is-invalid @enderror" name="w" placeholder="Lebar" value="{{ old('w') }}" required autocomplete="w" autofocus>
                                    <input id="t" type="number" class="form-control @error('t') is-invalid @enderror" name="t" placeholder="Tinggi" value="{{ old('t') }}" required autocomplete="t" autofocus>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="material">{{ __('Material') }}</label>
                                <input id="material" type="text" class="form-control @error('material') is-invalid @enderror" name="material" value="{{ old('material') }}" required autocomplete="material" autofocus>
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
                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                                </div>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="stock">{{ __('Stok / Warna') }}</label>
                                <div class="input-group mb-3">
                                    <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" required autocomplete="stock" autofocus>
                                </div>
                                @error('price')
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
        <form action="" class="mb-3">
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
            </div>
            <button type="submit" class="btn btn-primary">Ubah</button>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah varian</button>
        </form>
        <div class="w-100 p-3 bg-primary rounded">
            <div class="text-bg-secondary rounded-circle-start">
                <div class="row">
                    <div class="col-2 col-md-1 p-2 border-end">
                        <h1 class="text-center">1-1</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection