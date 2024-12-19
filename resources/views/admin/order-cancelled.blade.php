@extends('layouts.app-admin', ['page' => 'order.cancel'])

@section('title')
Pembatalan Pesanan ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Order / Cancelled</h6>
<h1>Pembatalan / Pengembalian Pesanan</h1>
<div class="container fluid">
    <div class="modal" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="orderDetailModalLabel">Detail Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody id="productData"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.order') }}">Kelola Pesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.order-shipment') }}">Status Pengiriman</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">Pembatalan Pesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Ulasan Pembeli</a>
        </li>
    </ul>
    <div class="container-fluid pt-2 border border-top-0">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Detail Pesanan</th>
                    <th>Status Pengiriman</th>
                    <th>Alasan Pembatalan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->order_code}}</td>
                    <td>
                        <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#orderDetailModal" onclick="detail({{json_encode($orderItems[$order->order_code])}} @if(1==1) , '{{ asset('image/return_proof/'.$order->order_code.'/proof.png') }}' @endif)">
                            Lihat detail <i class="fa-solid fa-eye"></i>
                        </button>
                    </td>
                    <td>{{$order->status}}</td>
                    <td>{{$order->note}}</td>
                    <td>
                        @if ($order->status != 'Cancelled')
                        <form action="{{ route('admin.order-cancel_confirm', $order) }}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="status" value="Confirm">
                            <button type="submit" class="btn btn-warning">Terima Pembatalan</button>
                        </form>
                        <form action="{{ route('admin.order-cancel_confirm', $order) }}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="status" value="@if(file_exists(asset('image/return_proof/'.$order->order_code.'/proof.png'))) Confirmed @else Processing @endif">
                            <button type="submit" class="btn btn-danger">Tolak Pembatalan</button>
                        </form>
                        @else
                         -
                        @endif
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

    function detail(data,image=null) {
        table.innerHTML = "";
        
        for(let i=1; i <= Object.keys(data).length; i++) {
            var row = document.createElement("tr");
            var col1 = document.createElement("td");
            col1.innerHTML = '<p class="m-0 p-0">' + data[i]["name"] + '</p>';
            col1.innerHTML += data[i]["variation"] != "base" ? "<br>" + data[i]["variation"] : " ";
            var col2 = document.createElement("td");
            col2.innerHTML = '<p class="m-0 p-0">Rp' + data[i]["price"] + '</p>';
            var col3 = document.createElement("td");
            col3.innerHTML = '<p class="m-0 p-0">' + data[i]["qty"] + '</p>';

            row.append(col1);
            row.append(col2);
            row.append(col3);
            table.appendChild(row);
        };

        if(image != null) {
            var text = document.createElement("h5");
            text.innerHTML = "Bukti Laporan";
            text.classList.add("mt-3");
            var img = document.createElement("img");
            img.src = image;
            img.classList.add("img-fluid","mt-3");
            table.appendChild(text);
            table.appendChild(img);
        }
    }
</script>
@endsection