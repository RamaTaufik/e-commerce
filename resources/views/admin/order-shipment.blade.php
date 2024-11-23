@extends('layouts.app-admin', ['page' => 'order.status'])

@section('title')
Status Pengiriman Pesanan ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Order / Shipment</h6>
<h1>Status Pengiriman Pesanan</h1>
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
    <div class="modal" id="shipmentDetailModal" tabindex="-1" aria-labelledby="shipmentDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="shipmentDetailModalLabel">Detail Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="position-relative mt-3 mx-3">
                        <i class="fa-solid fa-shop position-absolute bottom-100 start-0 translate-middle h4"></i>
                        {{-- <i class="fa-solid fa-motorcycle position-absolute bottom-100 start-50 translate-middle h5" style="z-index:1;"></i> --}}
                        <i class="fa-solid fa-house position-absolute bottom-100 start-100 translate-middle h4"></i>
                        <div class="position-relative w-100" style="height:fit-content;">
                            <div class="progress bg-dark-subtle" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-secondary text-end pe-1" style="width: 50"></div>
                                <div class="position-absolute top-50 start-0 translate-middle bg-secondary rounded-circle" style="width:30px;height:30px;"></div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h5 class="m-0 p-0">Riwayat Pengiriman</h5>
                            <div class="border-start position-relative">
                                <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle" style="width:10px;aspect-ratio:1/1;"></div>
                                <p class="m-0 p-0 mt-1 ms-3 text-secondary">
                                    <strong>09:00 - Pesanan diterima Seller</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.order') }}">Kelola Pesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">Status Pengiriman</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.order-cancelled') }}">Pembatalan Pesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Ulasan Pembeli</a>
        </li>
    </ul>
    <div class="container-fluid pt-2 border border-top-0">
        <form action="{{ route('admin.order-shipment') }}">
            <div class="row">
                <div class="col-3">
                    <label for="search">Filter</label>
                </div>
                <div class="col-3">
                    <label for="search">Dari Tanggal</label>
                </div>
                <div class="col-3">
                    <label for="pagination">Pagination</label>
                </div>
                <div class="col-3"></div>
                <div class="col-3">
                    <input type="text" name="search" id="search" class="form-control" value="{{$request->input('search') ?? ''}}" placeholder="Cari nama">
                </div>
                <div class="col-3">
                    <input type="date" name="from" id="from" class="form-control" value="{{$request->input('date') ?? ''}}">
                </div>
                <div class="col-3">
                    <select name="pagination" id="pagination" class="form-select">
                        <option value="20" {{$request->input('pagination') == '20' ? 'selected': ''}}>20</option>
                        <option value="50" {{$request->input('pagination') == '50' ? 'selected': ''}}>50</option>
                        <option value="100" {{$request->input('pagination') == '100' ? 'selected': ''}}>100</option>
                    </select>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                </div>
            </div>
        </form>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Pembeli</th>
                    <th>Detail Pesanan</th>
                    <th>Status Pengiriman</th>
                    <th>Detail Pengiriman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->order_code}}</td>
                    <td>{{$order->customer->first_name.' '.$order->customer->last_name}}</td>
                    <td><button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#orderDetailModal" onclick="detail({{json_encode($orderItems[$order->order_code])}})">Lihat detail <i class="fa-solid fa-eye"></i></button></td>
                    <td>{{$order->status}}</td>
                    <td><button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#shipmentDetailModal">Lihat detail pengiriman <i class="fa-solid fa-eye"></i></button></td>
                    <td>
                        <form action="" method="POST">
                            @csrf
                            <a class="btn btn-secondary p-0 px-2" href="{{ route('admin.order-arrived', $order->order_code) }}">Sampai</a>
                            {{-- <a class="btn btn-warning p-0 px-2" href="{{ route("admin.product-edit", $item->id) }}"><i class="fa-solid fa-pencil"></i></a> --}}
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

    function detail(data) {
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
    }
</script>
@endsection
