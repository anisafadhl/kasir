@extends('layouts.template')
@section('content')
<title>Detail | Kasir</title>
<style>
.table {
  border-collapse: collapse;
  width: 100%;
}

.td {
  color:black;
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:hover {background-color:#f5f5f5;}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Transaction</h6>
            </div>
            <div class="card-body">
                    <div class="row">
                    <div class="col-md-9"><font color="blue">Transaction Code : {{$ambil->kode_transaksi}}</font><br><font color="blue">Date : {{$ambil->tanggal_beli}}</font></div>
                    <div class="col-md-3"><font color="blue">Cashier : {{$kasir->name}}</font></div>
                    </div>
                    <table class="table mt-3">
                    <tr>
                        <th class="td">Items</th>
                        <th class="td">Amount</th>
                        <th class="td">Price</th>
                        <th class="td">Total</th>
                    </tr> 
                    @foreach($transaksi as $u)
                    <tr>
                        <td class="td">{{$u->nama_barang}}</td>
                        <td class="td">{{$u->jumlah_beli}}</td>
                        <td class="td">{{$u->harga_barang}}</td>
                        <td class="td">{{$u->total_harga}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="td" style="text-align:right">Total Price : </td>
                        <td class="td">{{$jumlah}}</td>
                        <input type="hidden" id="jumlah" value="{{$jumlah}}">
                    </tr>
                    <tr>
                        <td colspan="3" class="td" style="text-align:right">Payment : </td>
                        <td class="td">{{$kembalian->bayar}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="td" style="text-align:right">Money Changes : </td>
                        <td class="td">{{$kembalian->kembalian}}</td>
                    </tr>
                </table>
                <div class="form-group">
                    <a href="/cetak/{{$ambil->kode_transaksi}}" class="btn btn-primary">Print Receipt</a>
                </div>
                </div>
            </div>  
    </div>
</div>


@endsection