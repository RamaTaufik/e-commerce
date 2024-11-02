@extends('layouts.app')

@section('title')
Tracking Pesanan ● Plus-H
@endsection

@section('content')
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('order.cancel') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <p class="m-0 text-center fs-3">Yakin ingin membatalkan pesanan?</p>
                    <div class="my-3">
                        <label for="note">Beri tahu kami alasanmu</label>
                        <input type="text" class="form-control" name="note" id="note" placeholder="'Saya berubah pikiran','Duit saya dimakan tikus'">
                    </div>
                    <input type="hidden" name="order_code" id="cancelOrderCode">
                    <button type="submit" class="btn btn-danger w-100">Batalkan Pesanan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('order.confirm') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <p class="m-0 p-0 text-center fs-3">Konfirmasi penerimaan pesanan?</p>
                    <p class="m-0 mb-3 p-0 text-center">Pastikan barang anda sudah sampai dengan tepat.</p>
                    <input type="hidden" name="order_code" id="confirmOrderCode">
                    <button type="submit" class="btn btn-success w-100">Konfirmasi</button>
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
                        <a href="" class="m-0 p-0 nav-link active" aria-current="page" style="width: fit-content">Tracking Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order.history') }}" class=" m-0 p-0 nav-link" style="width: fit-content">Riwayat Pesanan</a>
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
                                <div class="progress bg-dark-subtle" role="progressbar" aria-label="Basic example" aria-valuenow="@if($order->status == 'Arrived') 100 @else @if($order->status == 'Shipping' || $order->status == 'Returning') 50 @else 0 @endif @endif" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-secondary text-end pe-1" style="width: @if($order->status == 'Arrived') 100% @else @if($order->status == 'Shipping' || $order->status == 'Returning') 50% @else 0 @endif @endif"></div>
                                    <div class="position-absolute top-50 start-0 translate-middle bg-secondary rounded-circle" style="width:30px;height:30px;"></div>
                                    @if ($order->status == 'Shipping' || $order->status == 'Returning')
                                    <div class="position-absolute top-50 start-50 translate-middle bg-secondary rounded-circle" style="width:30px;height:30px;"></div>
                                    @endif
                                    <div class="position-absolute top-50 start-100 translate-middle @if($order->status == 'Arrived') bg-secondary @else bg-dark-subtle @endif rounded-circle" style="width:30px;height:30px;"></div>
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
                                <p class="m-0 p-0 fs-5">Status</p>
                                <h5 class="m-0 p-0">{{$order->status}}</h5>
                            </div>
                            <p class="m-0 p-0 fs-5">Daftar Pesanan</p>
                            <ul>
                                @foreach($orderItems[$order->order_code] as $item)
                                <li class="d-flex w-100 justify-content-between">
                                    <span>{{$item->productVariant->product->name}}</span>
                                    <span>
                                        <strong class="text-secondary">{{$item->qty}}</strong> x 
                                        <strong>Rp{{number_format($item->productVariant->price,0,',','.')}}</strong>
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                            @if ($order->status == 'Processing')
                            <a href="#cancelModal" class="btn btn-danger ms-auto" data-bs-toggle="modal" onclick="changeOrderStatus('cancel',{{json_encode($order->order_code)}})">Batalkan Pesanan</a>
                            @else
                                @if ($order->status == 'Arrived')
                                <a href="#confirmModal" class="btn btn-success ms-auto" data-bs-toggle="modal" onclick="changeOrderStatus('confirm',{{json_encode($order->order_code)}})">Konfirmasi Sampai</a>
                                <a href="#cancelModal" class="btn btn-danger ms-auto" data-bs-toggle="modal" onclick="changeOrderStatus('cancel',{{json_encode($order->order_code)}})">Batalkan Pesanan</a>
                                @endif
                            @endif
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
    function changeOrderStatus(action,orderCode) {
        document.getElementById(action + 'OrderCode').value = orderCode;
    }
</script>
@endsection