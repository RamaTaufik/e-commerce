@extends('layouts.app')

@section('title')
Keranjang ● Plus-H
@endsection

@section('content')
<div class="container my-4">
    <form id="cart" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-8">
                <table class="table table-cart table-light">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <a class="mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('home') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                        <div class="d-flex">
                            <a id="saveChange" class="btn btn-success">Simpan</a>
                            <input type="submit" formaction="{{ route('cart.remove') }}" class="btn btn-danger" value="Hapus" />
                        </div>
                    </div>
                    <tr class="shadow-sm position-sticky" style="top:120px;z-index:1;">
                        <th class="px-3 rounded-start-5">
                            <input type="checkbox" name="all" id="all" onchange="checkAll()">
                        </th>
                        <th class="w-100 border-start"><p class="w-100 m-0 p-0 text-center">Produk</p></th>
                        <th class="border-start rounded-end-5"><p class="m-0 p-0 px-5 text-center">Jumlah/Harga</p></th>
                    </tr>
                    @if(session()->has('cart') && count(session('cart')) > 0)
                        @foreach (session('cart') as $cartItem)
                        <tr style="height:5px"></tr>
                        <tr class="shadow align-middle">
                            <td class="px-3 rounded-start-4">
                                <input type="checkbox" name="cart_item[]" id="{{$cartItem['code']}}" value="{{$cartItem['code']}}" onchange="check()">
                            </td>
                            <td class="border-start">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('image/products/'.$cart[$cartItem['code']]['image']) }}" class="product-img" alt="">
                                    <div class="flex-grow-1">
                                        <h5 class="text-end">{{$cart[$cartItem['code']]['name']}}</h5>
                                    </div>
                                </div>
                            </td>
                            <td class="border-start">
                                <h6 class="m-0 p-0 text-center">
                                    <a onclick="change('qty{{$loop->iteration}}',-1,'{{$cartItem['code']}}')" class="text-secondary"><i class="fa-solid fa-circle-minus"></i></a> 
                                    <span id="qty{{$loop->iteration}}" class="qty">{{$cartItem['qty']}}</span> 
                                    <a onclick="change('qty{{$loop->iteration}}',1,'{{$cartItem['code']}}')" class="text-secondary"><i class="fa-solid fa-circle-plus"></i></a>
                                </h6>
                                <p class="m-0 p-0 text-center">Rp{{number_format($cart[$cartItem['code']]['price'],0,'.',',')}}</p>
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
            </div>
            <div class="col-md-4">
                <div class="card border-0 p-3 shadow position-sticky" style="top:120px;">
                    @if(session()->has('cart'))
                        @foreach (session('cart') as $cartItem)
                        <div class="d-flex justify-content-between">
                            <h6>{{$cart[$cartItem['code']]['name']}}</h6>
                            <h6 class="text-secondary">{{$cart[$cartItem['code']]['qty']}} x Rp{{number_format($cart[$cartItem['code']]['price'],0,'.',',')}}</h6>
                        </div>
                        @endforeach
                    @endif
                    @guest
                    <div>
                        <a href="{{ route('login') }}" class="w-100 btn btn-primary">Pesan</a>
                    </div>
                    @else
                    <div>
                        {{-- <h4>Total</h4><h4 class="text-secondary">Rp{{number_format($total,0,'.',',')}}</h4> --}}
                        <select name="myAddress" id="myAddress" class="form-select my-2" 
                         onchange="changeAddress({{json_encode($myAddresses)}},{{json_encode($addresses)}})">
                            @if (count($myAddresses) > 0)
                            <option value="" hidden disabled selected> Pilih alamat pengiriman</option>
                                @foreach ($myAddresses as $myAddress)
                                <option value="{{$myAddress->id}}">{{$myAddress->address_name}}</option>
                                @endforeach
                            @endif
                            <option value="new">Alamat Baru</option>
                        </select>
                        <input type="text" name="address_name" id="address_name" class="form-control mb-2"" placeholder="'kantor', 'rumah', dll.">
                        <select  name="province_city" id="province_city" class="form-select mb-2">
                            <option value="" hidden selected disabled>Pilih Kabupaten/Kota</option>
                            @foreach ($addresses as $address)
                            <option value="{{$address->id}}">{{$address->province->name}} - {{$address->name}}</option>
                            @endforeach
                        </select>
                        <select  name="district" id="district" class="form-select mb-2" disabled>
                            <option value="" hidden selected disabled>Pilih Kecamatan</option>
                        </select>
                        <select  name="subdistrict" id="subdistrict" class="form-select mb-2" disabled>
                            <option value="" hidden selected disabled>Pilih Kelurahan</option>
                        </select>
                        <textarea name="address_detail" id="address_detail" placeholder="Detail alamat" class="form-control mb-2"></textarea>
                        <select name="shipment_id" id="shipment" class="form-select mb-3">
                            <option value="" hidden disabled selected> Pilih Pengiriman</option>
                            @foreach ($shipments as $shipment)
                            <option value="{{$shipment->id}}">{{strtoupper($shipment->shipment_name)}}</option>
                            @endforeach
                        </select>
                        <select name="ongkir" id="ongkir" class="form-select mb-3">
                            <option value="" hidden disabled selected> Pilih Paket Pengiriman</option>
                        </select>
                        <input type="submit" form="cart" formaction="{{ route('order.checkout') }}" class="btn btn-primary" value="Pesan" />
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script src="{{ asset('script/address.js') }}"></script>
<script src="{{ asset('script/jquery.min.js') }}"></script>
<script type="text/javascript">
    $('#shipment').on('change', function() {
        $.ajax({
            type: "post",
            url: "{{ route('order.check-ongkir') }}",
            data: $('#cart').serialize(),
            success: function(response) {
                $('#ongkir').empty();
                $.each(response[0]['costs'], function(key, value) {
                    $('#ongkir').append('<option value="'+value.cost[0].value+'"><strong>'+value.service+'</strong> - Rp'+value.cost[0].value+' ('+value.cost[0].etd+' hari)</option>');
                })
            },
            error: function() {
                alert('Kesalahan berpikir')
            }
        })
    })
</script>
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
<script>
    var qtyChange = {};

    function change(target, qty, code) {
        document.getElementById(target).innerHTML = parseInt(document.getElementById(target).innerHTML) + qty;
        document.getElementById(target).classList.add('text-warning');

        qtyChange[code] = [code,parseInt(document.getElementById(target).innerHTML)];
    }

    $('#saveChange').on('click', function() {
        $.ajax({
            type: "post",
            url: "{{ route('cart.update') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 'qtyChange': qtyChange },
            success: function() {
                alert('Jumlah beli berhasil diubah');
                var elements = document.getElementsByClassName('qty');
                for(let i=0;i < elements.length;i++) {
                    document.getElementById('qty' + (i+1)).classList.remove('text-warning')
                };
            },
            error: function() {
                alert('Kesalahan berpikir')
            }
        })
    })

</script>
<script>
    $('#province_city').on('change', function() {
        $.ajax({
            type: "post",
            url: "{{ route('order.get-district') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 'cityId': document.getElementById("province_city").value },
            success: function(response) {
                let districtSelect = document.getElementById("district");
                districtSelect.disabled = false;
                districtSelect.innerHTML = '';
                response['districts'].forEach(item => {
                    let option = document.createElement("option");

                    option.value = item['kecamatan'];
                    option.innerHTML = item['kecamatan'];

                    districtSelect.appendChild(option);
                });
                let subdistrictSelect = document.getElementById("subdistrict");
                subdistrictSelect.disabled = false;
                subdistrictSelect.innerHTML = '';
                response['subdistricts'].forEach(item => {
                    if(item['kecamatan'] == districtSelect.value) {
                        let option = document.createElement("option");

                        option.value = item['id'];
                        option.innerHTML = item['kelurahan'];

                        subdistrictSelect.appendChild(option);
                    }
                });
                districtSelect.onchange = function() {
                    let subdistrictSelect = document.getElementById("subdistrict");
                    subdistrictSelect.disabled = false;
                    subdistrictSelect.innerHTML = '';
                    response['subdistricts'].forEach(item => {
                        if(item['kecamatan'] == districtSelect.value) {
                            let option = document.createElement("option");

                            option.value = item['id'];
                            option.innerHTML = item['kelurahan'];

                            subdistrictSelect.appendChild(option);
                        }
                    });
                };
            },
            error: function() {
                alert('Kesalahan berpikir');
            }
        })
    })
</script>
@endsection