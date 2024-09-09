@extends('layouts.app-admin', ['page' => 'product'])

@section('title')
Kelola Produk ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Product</h6>
<h1>Selamat Datang di Dashboard Admin</h1>
<div class="container fluid">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">Kelola Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Arsip Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Ulasan Produk</a>
        </li>
    </ul>
    <div class="container-fluid border">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->category}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->stock}}</td>
                    <td>{{$item->status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection