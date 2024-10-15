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
        <button class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah</button>
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