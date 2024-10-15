@extends('layouts.app')

@section('head')
<script type="text/javascript"
 src="https://app.stg.midtrans.com/snap/snap.js"
 data-client-key="{{ config('midtrans.client_key') }}"></script>
@endsection

@section('title')
Pesan ● Plus-H
@endsection

@section('content')
<div class="container my-4">
    <a class="mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('cart') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
    <div class="row">
        <div class="col-12 col-md-6 h-100 overflow-y">
            <table class="table align-middle">
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Harga x Jumlah Beli</th>
                </tr>
                @foreach ($cart['items'] as $cartItem)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        {{$cartItem->productVariant->product->name}}
                        @if ($cartItem->productVariant->variation != 'base')
                        <br>{{$cartItem->productVariant->variation}}
                        @endif
                    </td>
                    <td>Rp{{number_format($cartItem->productVariant->product->price,0,'.',',')}} x {{$cartItem->qty}}</td>
                </tr>
                @endforeach
            </table>
            <div id="snap-container"></div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card border-0 p-3 shadow-sm">
                <iframe src="{{$transaction->redirect_url}}" frameborder="0" class="w-100" style="height:600px;"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('script/address.js') }}"></script>
@endsection