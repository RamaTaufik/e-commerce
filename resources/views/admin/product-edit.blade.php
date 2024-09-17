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
                    <form action="{{ route('admin.product_variant-create') }}" class="mb-4" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="row">
                            <div class="col-6 mb-1">
                                <label for="size_in_cm">{{ __('Ukuran (cm)') }}</label>
                                <select id="size_in_cm" class="form-select @error('size_in_cm') is-invalid @enderror" name="size_in_cm" value="{{ old('size_in_cm') }}" required autocomplete="size_in_cm" autofocus>
                                    <option value="sm" title="Small">SM</option>
                                    <option value="md" title="Medium">MD</option>
                                    <option value="lg" title="Large">LG</option>
                                    <option value="xl" title="Extra Large">XL</option>
                                </select>
                                @error('size_in_cm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6 mb-1">
                                <label for="weight_in_gram">{{ __('Berat (gram)') }}</label>
                                <input id="weight_in_gram" type="number" class="form-control @error('weight_in_gram') is-invalid @enderror" name="weight_in_gram" placeholder="Berat" value="{{ old('weight_in_gram') }}" required autocomplete="weight_in_gram" autofocus>
                                @error('size_in_cm')
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
                                <div class="input-group">
                                    <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" placeholder="xx" value="{{ old('stock') }}" required autocomplete="stock" autofocus>
                                    <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" placeholder="Biru, Ungu, dll." value="{{ old('color') }}" autocomplete="color" autofocus>
                                </div>
                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('color')
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
            </div>
            <button type="submit" class="btn btn-primary">Ubah</button>
            <a class="btn btn-secondary" data-bs-toggle="modal" href="#addModal"><i class="fa-solid fa-plus"></i> Tambah varian</a>
        </form>
        <div class="variant-list row">
            @foreach ($productVariant as $variant)
            <div class="col-6 col-lg-4 mb-2">
                <div class="variant-item">
                    <div class="w-50 p-2 text-bg-secondary rounded-start">
                        <h2 class="m-0 w-100 text-center"><i class="fa-solid fa-expand"></i> {{$variant['size']}}</h2>
                        <table>
                            <tr>
                                <td><i class="fa-solid fa-up-down"></i></td>
                                <td>{{$variant['h']}} cm</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-left-right"></i></td>
                                <td>{{$variant['w']}} cm</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-up-right-and-down-left-from-center"></i></td>
                                <td>{{$variant['t']}} cm</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-weight-hanging me-1"></i></td>
                                <td>{{$variant['weight_in_gram']}} gram</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-industry me-1"></i></td>
                                <td>{{$variant['material']}}</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-tag me-1"></i></td>
                                <td>Rp{{$variant['price']}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="d-flex align-items-center justify-content-center w-50 bg-primary rounded-end">
                        <table>
                        @if (count(explode(";", $variant['stock_per_color'])) > 1)
                        <?php $stock_per_color = explode(";", $variant['stock_per_color']); ?>
                            @foreach ($stock_per_color as $item)
                            <?php $i = explode("/", $item); ?>
                            <tr>
                                <td class="pe-2">{{$i[0]}}</td>
                                <td class="badge text-bg-secondary">{{$i[1]}}</td>
                            </tr>
                            @endforeach
                        @endif
                            <tr>
                                <td><strong class="me-2">Total Stok</strong></td>
                                <td><strong class="text-secondary">{{$variant['total_stock']}}</strong></td>
                            </tr>
                        </table>
                    </div>
                    <a class="variant-item-link" data-bs-toggle="modal" href="#addModal"></a>
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