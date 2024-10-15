@extends('layouts.app')

@section('title')
Tracking Pesanan ● Plus-H
@endsection

@section('content')
<div class="container">
    @foreach ($orders as $order)
    <div class="row mb-3 bg-light shadow">
        <div class="col-12 col-md-6 p-5">
            <div class="position-relative mt-3">
                <i class="fa-solid fa-shop position-absolute bottom-100 start-0 translate-middle h4"></i>
                {{-- <i class="fa-solid fa-motorcycle position-absolute bottom-100 start-50 translate-middle h5" style="z-index:1;"></i> --}}
                <i class="fa-solid fa-house position-absolute bottom-100 start-100 translate-middle h4"></i>
                <div class="position-relative w-100" style="height:fit-content;">
                    <div class="progress bg-dark-subtle" role="progressbar" aria-label="Basic example" aria-valuenow="@if($order->shipment_status == 'Arrived') 100 @else @if($order->shipment_status == 'Shipping') 50 @else 0 @endif @endif" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-secondary text-end pe-1" style="width: @if($order->shipment_status == 'Arrived') 100% @else @if($order->shipment_status == 'Shipping') 50% @else 0 @endif @endif"></div>
                        <div class="position-absolute top-50 start-0 translate-middle bg-secondary rounded-circle" style="width:30px;height:30px;"></div>
                        @if ($order->shipment_status == 'Shipping')
                        <div class="position-absolute top-50 start-50 translate-middle bg-secondary rounded-circle" style="width:30px;height:30px;"></div>
                        @endif
                        <div class="position-absolute top-50 start-100 translate-middle @if($order->shipment_status == 'Arrived') bg-secondary @else bg-dark-subtle @endif rounded-circle" style="width:30px;height:30px;"></div>
                    </div>
                </div>
                <div class="mt-4">
                <h5 class="m-0 p-0">Riwayat Pengiriman</h5>
                    <div class="border-start position-relative">
                        @if ($order->shipment_status != 'Processing')
                            @if ($order->shipment_status == 'Arrived')
                            <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle" style="width:10px;aspect-ratio:1/1;"></div>
                            <p class="m-0 p-0 mt-1 ms-3 text-secondary">
                                <strong>{{$order->updated_at->format('H:i')}} - Pesanan Sampai</strong>
                            </p>
                            @endif
                        <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle" style="width:10px;aspect-ratio:1/1;"></div>
                        <p class="m-0 p-0 mt-1 ms-3 @if($order->shipment_status == 'Shipping') text-secondary @else text-body-tertiary @endif">
                            <strong>{{$order->updated_at->format('H:i')}} - Pesanan Dalam Perjalanan</strong>
                        </p>
                        @endif
                        <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle" style="width:10px;aspect-ratio:1/1;"></div>
                        <p class="m-0 p-0 mt-1 ms-3 @if($order->shipment_status == 'Processing') text-secondary @else text-body-tertiary @endif">
                            <strong>{{$order->created_at->format('H:i')}} - Pesanan diterima Seller</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card border-0 h-100 p-3">
                <h3 class="m-0 p-0 text-end">{{$order->order_code}}</h3>
                <p class="m-0 p-0 fs-5">Daftar Pesanan</p>
                <ul>
                    @foreach($orderItems[$order->order_code] as $item)
                    <li class="d-flex w-100 justify-content-between">
                        <span>{{$item->productVariant->product->name}}</span>
                        <span>
                            <strong class="text-secondary">{{$item->qty}}</strong> x 
                            <strong>Rp{{number_format($item->productVariant->product->price,0,',','.')}}</strong>
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
