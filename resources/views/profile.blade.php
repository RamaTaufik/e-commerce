@extends('layouts.app')

@section('title')
Profil ● Plus-H
@endsection

@section('content')
<div class="container p-md-5 p-2">
    <div class="row">
        <div class="col-12 col-md-3">
            <a class="mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('home') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-9 bg-white border rounded">
            <form action="{{ route('profile-update', $customer->id) }}" method="POST" class="mb-3">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-12 col-md-10 offset-md-1 mt-5 mb-3">
                        <h1>Profil</h1>
                    </div>
                    <div class="col-12 col-md-10 offset-md-1 mb-3">
                        <label for="email">{{ __('Alamat Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $customer->user->email }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-5 offset-md-1 mb-3">
                        <label for="first_name">{{ __('Nama Depan') }}</label>
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $customer->first_name }}" required autocomplete="first_name" autofocus>
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-5 mb-3">
                        <label for="last_name">{{ __('Nama Belakang') }}</label>
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $customer->last_name }}" required autocomplete="last_name" autofocus>
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-10 offset-md-1 mb-3">
                        <label>Jenis Kelamin</label>
                        <div>
                            <input class="form-check-input" type="radio" name="gender" id="genderM" value="m" {{ $customer->gender == 'm' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="genderM">
                                Pria
                            </label>
                            <input class="form-check-input ms-2" type="radio" name="gender" id="genderW" value="w" {{ $customer->gender == 'w' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="genderW">
                                Wanita
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-md-10 offset-md-1 mb-3">
                        <label for="date_of_birth">{{ __('Tanggal Lahir') }}</label>
                        <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ $customer->date_of_birth }}" required autocomplete="date_of_birth" autofocus>
                        @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-10 offset-md-1 mb-3">
                        <label for="phone">{{ __('Nomor Telepon') }}</label>
                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror"  name="phone" value="{{ $customer->phone }}" pattern="[0-9]{10,}" autocomplete="phone" autofocus>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-10 offset-md-1 mb-4">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 py-5 border-top">
                    <form action="{{ route('profile-address-add') }}" method="post">
                        @csrf
                        @method('POST')
                        <h1>Alamat</h1>
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
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('script/address.js') }}"></script>
<script src="{{ asset('script/jquery.min.js') }}"></script>
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