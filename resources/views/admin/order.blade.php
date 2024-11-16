@extends('layouts.app-admin', ['page' => 'order'])

@section('title')
Kelola Pesanan ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Order</h6>
<h1>Kelola Pesanan</h1>
<div class="container fluid">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">Kelola Pesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.order-shipment') }}">Status Pengiriman</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.order-cancelled') }}">Pembatalan Pesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Ulasan Pembeli</a>
        </li>
    </ul>
    <div class="container-fluid pt-2 border border-top-0">
        <form action="{{ route('admin.order') }}">
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
                    <button class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah</button>
                </div>
            </div>
        </form>
        <table class="table">
            <thead class="align-middle">
                <tr>
                    <th>Kode</th>
                    <th>Pembeli</th>
                    <th>Alamat Pembeli</th>
                    <th>Total Barang & Harga</th>
                    <th>Status Pengiriman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->order_code}}</td>
                    <td>{{$order->customer->first_name.' '.$order->customer->last_name}}</td>
                    <td>{{$order->customerAddress->address_detail}}</td>
                    <div class="dropdown">
                        <td>
                            <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Rp{{number_format($order->total_price + $order->shipping_cost,0,'.',',')}}</a>
                            <ul class="dropdown-menu px-2">
                                @foreach ($orderItems[$order->order_code] as $item)
                                    <li>{{$item->productVariant->product->name.' x'.$item->qty}}</li>
                                @endforeach
                            </ul>
                        </td>
                    </div>
                    <td>{{$order->status}}</td>
                    {{-- <td>
                        <button type="button" class="btn btn-secondary p-0 px-2" onclick="detail({{ json_encode($item) }}, {{ json_encode($item->productVariant) }}, {{ json_encode($item->productVariant) }})" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="fa-regular fa-eye"></i></button>
                    </td> --}}
                    <td>
                        <form action="" method="POST">
                            @csrf
                            <a class="btn btn-secondary p-0 px-2" href="{{ route('admin.order-ship', $order->order_code) }}">Kirim</a>
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
