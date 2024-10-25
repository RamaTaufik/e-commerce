@extends('layouts.app-admin', ['page' => 'order-shipment'])

@section('title')
Status Pengiriman Pesanan ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Order / Shipment</h6>
<h1>Status Pengiriman Pesanan</h1>
<div class="container fluid">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.order') }}">Kelola Pesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">Status Pengiriman</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Pembatalan Pesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Ulasan Pembeli</a>
        </li>
    </ul>
    <div class="container-fluid pt-2 border border-top-0">
        <table class="table">
            <thead class="align-middle">
                <tr>
                    <th>Kode</th>
                    <th>Detail Pesanan</th>
                    <th>Status Pengiriman</th>
                    <th>Detail Pengiriman</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->order_code}}</td>
                    <td><a href="">Lihat detail <i class="fa-solid fa-eye"></i></a></td>
                    <td>{{$order->status}}</td>
                    <td><a href="">Lihat detail pengiriman <i class="fa-solid fa-eye"></i></a></td>
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