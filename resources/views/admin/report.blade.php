@extends('layouts.app-admin', ['page' => 'report'])

@section('title')
Laporan Penjualan ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Report</h6>
<h1>Laporan Penjualan</h1>
<div class="container fluid">
    <div class="col-10 py-2">
        <div class="row">
            <div class="col-12 mb-3">
                <form action="{{ route('admin.report') }}">
                    <div class="row">
                        <div class="col-6">
                            <select name="timespan" id="timespan" class="form-select">
                                <option value="7" {{$request->input('timespan') == '7' ? 'selected': ''}}>1 minggu yang lalu</option>
                                <option value="30" {{$request->input('timespan') == '30' ? 'selected': ''}}>1 bulan yang lalu</option>
                                <option value="365" {{$request->input('timespan') == '365' ? 'selected': ''}}>1 tahun yang lalu</option>
                                <option value="all" {{$request->input('timespan') == 'all' ? 'selected': ''}}>Keseluruhan</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 mb-3">
                <table class="w-100 bg-primary border rounded">
                    <tr class="text-head align-top">
                        <td scope="col" class="px-2 pt-2 border-start">
                            <h5 class="m-0 p-0">Pesanan Selesai</h5>
                        </td>
                        <td scope="col" class="px-2 pt-2 border-start">
                            <h5 class="m-0 p-0">Pesanan Dibatalkan</h5>
                        </td>
                        <td scope="col" colspan="2" class="px-2 pt-2 border-start">
                            <h5 class="m-0 p-0">Total Pesanan</h5>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-2 pb-2 border-start">
                            <h4 class="m-0 p-0"><strong>{{$statistics['done']}}</strong></h4>
                        </td>
                        <td class="px-2 pb-2 border-start">
                            <h4 class="m-0 p-0"><strong>{{$statistics['cancelled']}}</strong></h4>
                        </td>
                        <td class="px-2 pb-2 border-start" colspan="2">
                            <h4 class="m-0 p-0"><strong>{{$statistics['total']}}</strong></h4>
                        </td>
                    </tr>
                    <tr class="text-head align-top border-top">
                        <td scope="col" colspan="2" class="px-2 pt-2">
                            <h5 class="m-0 p-0">Jumlah Produk Terjual</h5>
                        </td>
                        <td scope="col" colspan="2" class="px-2 pt-2 border-start">
                            <h5 class="m-0 p-0">Rata-rata Jumlah Produk</h5>
                            <h6 class="m-0 p-0 text-inactive">per Pembelian</h6>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-2 pb-2" colspan="2">
                            <h4 class="m-0 p-0"><strong>{{$statistics['qty_sum']}}</strong></h4>
                        </td>
                        <td class="px-2 pb-2 border-start" colspan="2">
                            <h4 class="m-0 p-0"><strong>{{$statistics['qty_avg']}}</strong></h4>
                        </td>
                    </tr>
                    <tr class="text-head align-top border-top">
                        <td scope="col" colspan="2" class="px-2 pt-2">
                            <h5 class="m-0 p-0">Total Penjualan</h5>
                        </td>
                        <td scope="col" colspan="2" class="px-2 pt-2 border-start">
                            <h5 class="m-0 p-0">Rata-rata Penjualan</h5>
                            <h6 class="m-0 p-0 text-inactive">per Pesanan</h6>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="px-2 pb-2">
                            <h4 class="m-0 p-0"><strong>Rp{{$statistics['net_sum']}}</strong></h4>
                        </td>
                        <td colspan="2" class="px-2 pb-2 border-start">
                            <h4 class="m-0 p-0"><strong>Rp{{$statistics['net_avg']}}</strong></h4>
                        </td>
                    </tr>
                </table>
            </div>
            {{-- <div class="col-4">
                <div class="accordion accordion-custom m-0 p-0" id="timeSpan">
                    <a class="accordion-btn collapsed" role="button" data-bs-toggle="collapse" href="#from" aria-expanded="false" aria-controls="from">
                        Dari...
                    </a>
                    -
                    <a class="accordion-btn" role="button" data-bs-toggle="collapse" href="#until" aria-expanded="true" aria-controls="until">
                        Sampai...
                    </a>
                    <div class="accordion-item">
                        <div id="from" class="accordion-collapse collapse" data-bs-parent="#timeSpan">
                            <div class="d-flex justify-content-between p-2 text-bg-dark">
                                <i class="fa-solid fa-caret-left h5"></i>
                                <span class="h5">Juni 2024</span>
                                <i class="fa-solid fa-caret-right h5"></i>
                            </div>
                            <div class="bg-white">
                                <table class="table table-bordered">
                                    <tr class="text-center">
                                        <th>M</th><th>S</th><th>S</th><th>R</th><th>K</th><th>J</th><th>S</th>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="text-inactive">26</td><td class="text-inactive">27</td><td class="text-inactive">28</td><td class="text-inactive">29</td><td class="text-inactive">30</td><td class="text-inactive">31</td><td>1</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>30</td><td class="text-inactive">1</td><td class="text-inactive">2</td><td class="text-inactive">3</td><td class="text-inactive">4</td><td class="text-inactive">5</td><td class="text-inactive">6</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="until" class="accordion-collapse collapse show" data-bs-parent="#timeSpan">
                            <div class="d-flex justify-content-between p-2 text-bg-dark">
                                <i class="fa-solid fa-caret-left h5"></i>
                                <span class="h5">Juni 2024</span>
                                <i class="fa-solid fa-caret-right h5"></i>
                            </div>
                            <div class="bg-white">
                                <table class="table table-bordered">
                                    <tr class="text-center">
                                        <th>M</th><th>S</th><th>S</th><th>R</th><th>K</th><th>J</th><th>S</th>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="text-inactive">26</td><td class="text-inactive">27</td><td class="text-inactive">28</td><td class="text-inactive">29</td><td class="text-inactive">30</td><td class="text-inactive">31</td><td>1</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>9</td><td>10</td><td>11</td><td class="bg-dark-subtle">12</td><td>13</td><td>14</td><td>15</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>30</td><td class="text-inactive">1</td><td class="text-inactive">2</td><td class="text-inactive">3</td><td class="text-inactive">4</td><td class="text-inactive">5</td><td class="text-inactive">6</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-12">
                <h3>Statistik Penjualan Produk</h3>
                <table class="table table-bordered mt-2">
                    <tr class="text-head">
                        <th>Rentang Total Harga</th>
                        <th>Jumlah Pesanan</th>
                        <th>Rata-rata Qty <br><sup class="text-inactive">per Pesanan</sup></th>
                        <th>Subtotal Penjualan</th>
                    </tr>
                    <tr>
                        <td>Rp0 - Rp100.000</td>
                        <td>252.334 <sub class="text-inactive">/ 439.243</sub></td>
                        <td>5</td>
                        <td>Rp42.103.021</td>
                    </tr>
                    <tr>
                        <td>Rp100.000 - Rp250.000</td>
                        <td>132.324 <sub class="text-inactive">/ 439.243</sub></td>
                        <td>3</td>
                        <td>Rp23.833.911</td>
                    </tr>
                    <tr>
                        <td>Rp250.000 - Rp500.000</td>
                        <td>54.302 <sub class="text-inactive">/ 439.243</sub></td>
                        <td>12</td>
                        <td>Rp5.730.000</td>
                    </tr>
                    <tr>
                        <td>Rp500.000 - Rp1.000.000</td>
                        <td>5.402 <sub class="text-inactive">/ 439.243</sub></td>
                        <td>23</td>
                        <td>Rp3.700.000</td>
                    </tr>
                    <tr>
                        <td>Rp1.000.000 - Rp5.000.000</td>
                        <td>9.032 <sub class="text-inactive">/ 439.243</sub></td>
                        <td>18</td>
                        <td>Rp4.270.000</td>
                    </tr>
                    <tr>
                        <td>+Rp5.000.000</td>
                        <td>443 <sub class="text-inactive">/ 439.243</sub></td>
                        <td>12</td>
                        <td>Rp34.209.423</td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
            </div>
        </div>
    </div>
</div>
@endsection
