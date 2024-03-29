@extends('layouts.template')
@section('content')
<title>Data Laporan | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Transaction Code</th>
                        <th>Total Price</th>
                        <th>Money Changes</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $i => $u)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$u->kode_transaksi_kembalian}}</td>
                        <td>{{$u->bayar}}</td>
                        <td>{{$u->kembalian}}</td>
                        <td>{{$u->tanggal_transaksi}}</td>
                        <td><a href="/laporan/{{ $u->kode_transaksi_kembalian}}" class="btn btn-warning btn-sm ml-2"><i class="fa fa-file"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



@endsection