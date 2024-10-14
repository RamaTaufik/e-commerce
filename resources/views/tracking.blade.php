@extends('layouts.app')

@section('title')
Tracking Pesanan ● Plus-H
@endsection

@section('content')
<div class="container bg-light shadow">
    @foreach ($orders as $order)
    <div class="row">
        <div class="col-12 col-md-6 p-5">
            <div class="position-relative mt-3">
                <i class="fa-solid fa-shop position-absolute bottom-100 start-0 translate-middle h4"></i>
                {{-- <i class="fa-solid fa-motorcycle position-absolute bottom-100 start-50 translate-middle h5" style="z-index:1;"></i> --}}
                <i class="fa-solid fa-house position-absolute bottom-100 start-100 translate-middle h4"></i>
                <div class="position-relative w-100" style="height:fit-content;">
                    <div class="progress bg-dark-subtle" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-secondary text-end pe-1" style="width: 0"></div>
                        <div class="position-absolute top-50 start-0 translate-middle bg-secondary rounded-circle" style="width:30px;height:30px;"></div>
                        {{-- <div class="position-absolute top-50 start-50 translate-middle bg-secondary rounded-circle" style="width:30px;height:30px;"></div> --}}
                        <div class="position-absolute top-50 start-100 translate-middle bg-dark-subtle rounded-circle" style="width:30px;height:30px;"></div>
                    </div>
                </div>
                <div class="mt-4">
                <h5 class="m-0 p-0">Riwayat Pengiriman</h5>
                    <div class="ms-2 border-start position-relative">
                        <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle text-white" style="width:10px;aspect-ratio:1/1;"></div>
                        <p class="m-0 p-0 mt-1 ms-3 text-secondary"><strong>{{$order->created_at->format('H:i')}} - Pesanan diterima Seller</strong></p>
                        {{-- <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle text-white" style="width:10px;aspect-ratio:1/1;"></div>
                        <p class="m-0 p-0 mt-1 ms-3 text-body-tertiary">08:21 - Pesanan sedang di tol Cipali</p>
                        <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle text-white" style="width:10px;aspect-ratio:1/1;"></div>
                        <p class="m-0 p-0 mt-1 ms-3 text-body-tertiary">07:40 - Pesanan dikirim</p>
                        <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle text-white" style="width:10px;aspect-ratio:1/1;"></div>
                        <p class="m-0 p-0 mt-1 ms-3 text-body-tertiary">07:33 - Pesanan diterima kurir</p>
                        <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle text-white" style="width:10px;aspect-ratio:1/1;"></div>
                        <p class="m-0 p-0 mt-1 ms-3 text-body-tertiary">06:57 - Pesanan diproses</p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card border-0 h-100 p-3">
                <h5 class="m-0 p-0">Daftar Pesanan</h5>
                <ul>
                    @foreach($orderItems[$order->order_code] as $item)
                    <li>{{$item->productVariant->product->name}} x <span class="text-secondary">{{$item->qty}}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
