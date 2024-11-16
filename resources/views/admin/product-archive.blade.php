@extends('layouts.app-admin', ['page' => 'product.archive'])

@section('title')
Kelola Produk ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Product / Archive</h6>
<h1>Arsip Produk</h1>
<div class="container fluid">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.product') }}">Kelola Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">Arsip Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Ulasan Produk</a>
        </li>
    </ul>
    <div class="container-fluid pt-2 border border-top-0">
        <form action="{{ route('admin.product-archive') }}">
            <div class="row">
                <div class="col-3">
                    <label for="search">Filter</label>
                </div>
                <div class="col-3">
                    <label for="sort">Urutkan</label>
                </div>
                <div class="col-3">
                    <label for="pagination">Pagination</label>
                </div>
                <div class="col-3"></div>
                <div class="col-3">
                    <input type="text" name="search" id="search" class="form-control" value="{{$request->input('search') ?? ''}}" placeholder="Cari nama">
                </div>
                <div class="col-3">
                    <select name="pagination" id="pagination" class="form-select">
                        <option value="20" {{$request->input('pagination') == '20' ? 'selected': ''}}>20</option>
                        <option value="50" {{$request->input('pagination') == '50' ? 'selected': ''}}>50</option>
                        <option value="100" {{$request->input('pagination') == '100' ? 'selected': ''}}>100</option>
                    </select>
                </div>
                <div class="col-3">
                    <select name="sort" id="sort" class="form-select">
                        <option value="terlama" {{$request->input('sort') == 'terlama' ? 'selected': ''}}>Terlama</option>
                        <option value="terbaru" {{$request->input('sort') == 'terbaru' ? 'selected': ''}}>Terbaru</option>
                    </select>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                    <button class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah</button>
                </div>
            </div>
        </form>
        <table class="table">
            <thead class="align-middle">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Jumlah Varian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->category}}</td>
                    <td>{{$item->total_variant}}</td>
                    <td>
                        <form action="{{ route('admin.product-delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-secondary p-0 px-2" href="{{ route('admin.product-publishing', $item->id) }}">Publikasi</a>
                            <a class="btn btn-warning p-0 px-2" href="{{ route("admin.product-edit", $item->id) }}"><i class="fa-solid fa-pencil"></i></a>
                            <button type="submit" class="btn btn-danger p-0 px-2"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
