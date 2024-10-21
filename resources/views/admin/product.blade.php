@extends('layouts.app-admin', ['page' => 'product'])

@section('title')
Kelola Produk ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Product</h6>
<h1>Kelola Produk</h1>
<div class="container fluid">
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="detailModalLabel">Detail & Varian Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-7">
                            <img src="{{ asset('image/products/1-1/dis1.jfif') }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-5">
                            <h4 class="text-secondary m-0 p-0" id="productName"></h4>
                            <table id="productData"></table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="addModalLabel">Tambah Produk Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.product-create') }}" class="mb-4" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="name">{{ __('Nama Produk') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="category_code">{{ __('Kategori') }}</label>
                                <select id="category_code" class="form-select @error('category_code') is-invalid @enderror" name="category_code" value="{{ old('category_code') }}" required autocomplete="category_code" autofocus>
                                    @foreach ($category as $c)
                                    <option value="{{$c->category_code}}">{{$c->category_code}} / {{$c->name}}</option>
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
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
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
                                <label for="stock">{{ __('Stok') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">Base</span>
                                    <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" placeholder="xx" value="{{ old('stock') }}" required autocomplete="stock" autofocus>
                                </div>
                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
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
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">Kelola Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.product-archive') }}">Arsip Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Ulasan Produk</a>
        </li>
    </ul>
    <div class="container-fluid pt-2 border border-top-0">
        <button class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah</button>
        <table class="table">
            <thead class="align-middle">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Total Stok</th>
                    <th>Detail & Varian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->category}}</td>
                    <td>{{$item->total_stock}}</td>
                    <td>
                        <button type="button" class="btn btn-secondary p-0 px-2" onclick="detail({{ json_encode($item) }}, {{ json_encode($item->productVariant) }}, {{ json_encode($item->productVariant) }})" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="fa-regular fa-eye"></i></button>
                    </td>
                    <td>{{$item->status}}</td>
                    <td>
                        <form action="{{ route('admin.product-delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-secondary p-0 px-2" href="{{ route('admin.product-archiving', $item->id) }}">Arsipkan</a>
                            <a class="btn btn-warning p-0 px-2" href="{{ route("admin.product-edit", $item->id) }}"><i class="fa-solid fa-pencil"></i></a>
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger p-0 px-2"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    var table = document.getElementById("productData");
    
    const data_list = ["Kategori","Ukuran","Dimensi","Berat","Material","Harga","Stok","Warna"];

    function detail(product,variants,images) {
        table.innerHTML = "";

        const data = [
            product['category'],
            '<a href="" class="badge text-bg-secondary">' + variants[0]['size(cm)'].split(".")[0] + "</a>",
            variants[0]['size(cm)'].split(".")[1].split("-").join(" cm x ") + " cm",
            variants[0]['weight(g)'].split(".")[1] + " gram",
            variants[0]['material'],
            "Rp" + variants[0]['price'].toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'),
            variants[0]['stock'],
            variants[0]['color']
        ];

        document.getElementById("productName").innerHTML = product['name'];

        data.forEach((item,i) => {
            if(item != null) {
                var row = document.createElement("tr");
                var col = document.createElement("td");
                var col_separator = document.createElement("td");
                var col_value = document.createElement("td");
                col_separator.innerHTML = ":";
                
                col.innerHTML = data_list[i];
                col_value.innerHTML = item;
                row.append(col);
                row.append(col_separator);
                row.append(col_value);
                table.appendChild(row);
            }
        });
    }
</script>
@endsection