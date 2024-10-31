@extends('layouts.app')

@section('title')
Riwayat Pesanan ● Plus-H
@endsection

@section('content')
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('review.add') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <p class="m-0 text-center fs-3">Tinggalkan Ulasan</p>
                    <div class="my-2">
                        <label for="customer_review">Ulasan</label>
                        <textarea class="form-control" name="customer_review"></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="rating">Rating</label>
                        <input type="number" class="form-control" name="rating" min="1" max="5" step="0.1" value="1">
                    </div>
                    <div class="mb-3">
                        <label for="picture[]">Gambar</label>
                        <input type="file" class="form-control" name="picture[]">
                    </div>
                    <input type="hidden" name="order_item_id" id="orderItemId">
                    <button type="submit" class="btn btn-success w-100">Kirim Ulasan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12 col-md-2 position-sticky">
            <div class="bg-light p-3">
                <ul class="nav nav-underline flex-md-column">
                    <li class="nav-item">
                        <a href="{{ route('order.tracking') }}" class="m-0 p-0 nav-link" style="width: fit-content">Tracking Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class=" m-0 p-0 nav-link active" aria-current="page" style="width: fit-content">Riwayat Pesanan</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-10">
            @if (count($orders) > 0)
                @foreach ($orders as $order)
                <div class="row mb-3 mx-3 bg-light shadow">
                    <div class="col-12 col-md-6 p-5">
                        <div class="position-relative mt-3">
                            <i class="fa-solid fa-shop position-absolute bottom-100 start-0 translate-middle h4"></i>
                            {{-- <i class="fa-solid fa-motorcycle position-absolute bottom-100 start-50 translate-middle h5" style="z-index:1;"></i> --}}
                            <i class="fa-solid fa-house position-absolute bottom-100 start-100 translate-middle h4"></i>
                            <div class="position-relative w-100" style="height:fit-content;">
                                <div class="progress bg-dark-subtle" role="progressbar" aria-label="Basic example" aria-valuenow="@if($order->status == 'Arrived' || $order->status == 'Confirmed') 100 @else @if($order->status == 'Shipping' || $order->status == 'Returning') 50 @else 0 @endif @endif" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-secondary text-end pe-1" style="width: @if($order->status == 'Arrived' || $order->status == 'Confirmed') 100% @else @if($order->status == 'Shipping' || $order->status == 'Returning') 50% @else 0 @endif @endif"></div>
                                    <div class="position-absolute top-50 start-0 translate-middle bg-secondary rounded-circle" style="width:30px;height:30px;"></div>
                                    @if ($order->status == 'Shipping' || $order->status == 'Returning')
                                    <div class="position-absolute top-50 start-50 translate-middle bg-secondary rounded-circle" style="width:30px;height:30px;"></div>
                                    @endif
                                    <div class="position-absolute top-50 start-100 translate-middle @if($order->status == 'Arrived' || $order->status == 'Confirmed') bg-secondary @else bg-dark-subtle @endif rounded-circle" style="width:30px;height:30px;"></div>
                                </div>
                            </div>
                            <div class="mt-4">
                            <h5 class="m-0 p-0">Riwayat Pengiriman</h5>
                                <div class="border-start position-relative">
                                    @if ($order->status != 'Processing')
                                        @if ($order->status == 'Arrived' || $order->status == 'Confirmed')
                                        <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle" style="width:10px;aspect-ratio:1/1;"></div>
                                        <p class="m-0 p-0 mt-1 ms-3 text-secondary">
                                            <strong>{{$order->updated_at->format('H:i')}} - Pesanan Sampai</strong>
                                        </p>
                                        @endif
                                    <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle" style="width:10px;aspect-ratio:1/1;"></div>
                                    <p class="m-0 p-0 mt-1 ms-3 @if($order->status == 'Shipping' || $order->status == 'Returning') text-secondary @else text-body-tertiary @endif">
                                        <strong>{{$order->updated_at->format('H:i')}} - Pesanan Dalam Perjalanan</strong>
                                    </p>
                                    @endif
                                    <div class="position-absolute mt-3 rounded-circle bg-dark-subtle start-0 translate-middle" style="width:10px;aspect-ratio:1/1;"></div>
                                    <p class="m-0 p-0 mt-1 ms-3 @if($order->status == 'Processing') text-secondary @else text-body-tertiary @endif">
                                        <strong>{{$order->created_at->format('H:i')}} - Pesanan diterima Seller</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card border-0 h-100 p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="m-0 p-0 fs-5">Resi Pengiriman</p>
                                <h5 class="m-0 p-0">{{$order->order_code}}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="m-0 p-0 fs-5">
                                    Status
                                </p>
                                <h5 class="m-0 p-0">
                                    @if($order->status == 'Cancelled' || $order->status == 'Returning') Dibatalkan @else @if($order->status == 'Confirmed') Diterima @endif @endif
                                </h5>
                            </div>
                            <p class="m-0 p-0 fs-5">Daftar Pesanan</p>
                            <ul>
                                @foreach($orderItems[$order->order_code] as $item)
                                <li class="d-flex w-100 justify-content-between align-items-center">
                                    <span>{{$item->productVariant->product->name}}</span>
                                    @if ($order->status == 'Confirmed')
                                    <a href="#reviewModal" class="btn btn-success ms-auto" data-bs-toggle="modal" onclick="review({{json_encode($item->id)}})">Ulas</a>
                                    @else
                                    <span>
                                        <strong class="text-secondary">{{$item->qty}}</strong> x 
                                        <strong>Rp{{number_format($item->productVariant->price,0,',','.')}}</strong>
                                    </span>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="py-5 mx-3 bg-light">
                <h4 class="py-5 text-secondary text-center">
                    Oops, kamu belum memesan barang apapun. <br>
                    <a href="{{ route('home') }}" class="btn btn-secondary fs-4">Belanja Sekarang</a>
                </h4>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function review(orderItemId) {
        document.getElementById("orderItemId").value = orderItemId;
    }
</script>
@endsection