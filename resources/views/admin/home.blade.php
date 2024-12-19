@extends('layouts.app-admin', ['page' => 'home'])

@section('title')
Dashboard ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Dashboard</h6>
<h1>Selamat Datang di Dashboard Admin</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-4 p-3">
            <div class="card bg-secondary">
                <div class="card-body">
                    <p class="card-text text-white">Pesanan Dalam Proses</p>
                    <h5 class="card-title text-white">{{$card['processing']}}</h5>
                </div>
            </div>
        </div>
        <div class="col-4 p-3">
            <div class="card bg-secondary">
                <div class="card-body">
                    <p class="card-text text-white">Request Pembatalan</p>
                    <h5 class="card-title text-white">{{$card['cancelling']}}</h5>
                </div>
            </div>
        </div>
        <div class="col-4 p-3">
            <div class="card bg-secondary">
                <div class="card-body">
                    <p class="card-text text-white">Omzet Bulan Ini</p>
                    <h5 class="card-title text-white">Rp{{$card['this_month_omzet']}}</h5>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <canvas id="favoriteChart" style="width:100%;"></canvas>
            <script>
                import Chart from 'chart.js/auto'

                new Chart(document.getElementById("favoriteChart"), {
                    type: "bar",
                    data: {
                        labels: ["italy","france"],
                        datasets: [{
                            backgroundColor: "#fdd411",
                            data : [89,44],
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Statistik Barang Terfavorit",
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>
@endsection