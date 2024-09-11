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
            variants[0]['weight(g)'] + " gram",
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