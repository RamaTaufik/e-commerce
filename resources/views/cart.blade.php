@extends('layouts.app')

@section('title')
Keranjang ● Plus-H
@endsection

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-8">
            <form id="cart" method="post">
                @csrf
                @method('POST')
                <table class="table table-cart table-light">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <a class="mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('home') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                        <input type="submit" form="cart" formaction="{{ route('cart.remove') }}" class="btn btn-danger" value="Hapus" />
                    </div>
                    <tr class="shadow-sm position-sticky" style="top:120px;z-index:1;">
                        <th class="px-3 rounded-start-5">
                            <input type="checkbox" name="all" id="all" onchange="checkAll()">
                        </th>
                        <th class="w-100 border-start"><p class="w-100 m-0 p-0 text-center">Produk</p></th>
                        <th class="border-start rounded-end-5"><p class="m-0 p-0 px-5 text-center">Jumlah/Harga</p></th>
                    </tr>
                    @if(session()->has('cart'))
                        @foreach (session('cart') as $cartItem)
                        <tr style="height:5px"></tr>
                        <tr class="shadow align-middle">
                            <td class="px-3 rounded-start-4">
                                <input type="checkbox" name="cart_item[]" id="{{$cartItem['product_variant_code'].'.'.$cartItem['color']}}" value="{{$cartItem['product_variant_code'].'.'.$cartItem['color']}}" onchange="check()">
                            </td>
                            <td class="border-start">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('image/products/'.$cart[$cartItem['product_variant_code'].'.'.$cartItem['color']]['image']) }}" class="product-img" alt="">
                                    <div class="flex-grow-1">
                                        <h5 class="text-end">{{$cart[$cartItem['product_variant_code'].'.'.$cartItem['color']]['name']}}</h5>
                                        @if ($cart[$cartItem['product_variant_code'].'.'.$cartItem['color']]['color']!=NULL)
                                        <p class="m-0 p-0">
                                            {{$cart[$cartItem['product_variant_code'].'.'.$cartItem['color']]['size']}} | 
                                            {{$cart[$cartItem['product_variant_code'].'.'.$cartItem['color']]['color']}}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="border-start">
                                <h6 class="m-0 p-0 text-center">{{$cartItem['qty']}}x</h6>
                                <p class="m-0 p-0 text-center">Rp{{number_format($cart[$cartItem['product_variant_code'].'.'.$cartItem['color']]['price'],0,'.',',')}}</p>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr style="height:5px;"></tr>
                    <tr>
                        <td colspan="4" class="py-5 rounded align-middle">
                            <h4 class="py-5 text-secondary text-center">
                                Oops, kamu belum menambahkan barang apapun. <br>
                                <a href="{{ route('home') }}" class="btn btn-secondary fs-4">Belanja Sekarang</a>
                            </h4>
                        </td>
                    </tr>
                    @endif
                </table>
            </form>
        </div>
        <div class="col-md-4">
            <div class="card border-0 p-3 shadow position-sticky" style="top:120px;">
                @if(session()->has('cart'))
                    @foreach (session('cart') as $cartItem)
                    <div class="d-flex justify-content-between text-head">
                        <h6>{{$cart[$cartItem['product_variant_code'].'.'.$cartItem['color']]['name']}}</h6>
                        <h6 class="text-secondary">Rp{{number_format($cart[$cartItem['product_variant_code'].'.'.$cartItem['color']]['price'],0,'.',',')}}</h6>
                    </div>
                    @endforeach
                <div class="d-flex justify-content-between text-head">
                    {{-- <h4>Total</h4><h4 class="text-secondary">Rp{{number_format($total,0,'.',',')}}</h4> --}}
                </div>
                @endif
                <input type="submit" form="cart" formaction="{{ route('order.checkout') }}" class="btn btn-primary" value="Checkout" />
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let cartItems = document.getElementsByName("cart_item[]");
    let allCheckbox = document.getElementById("all");

    function check() {
        for(let i = 0; i < cartItems.length; i++) {
            if(!cartItems[i].checked) {
                allCheckbox.checked = false;
                return;
            }
            allCheckbox.checked = true;
        };
    }

    function checkAll() {
        cartItems.forEach(checkbox => {
            checkbox.checked = allCheckbox.checked;
        })
    }
</script>
@endsection