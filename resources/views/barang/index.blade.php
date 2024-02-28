@extends('layouts.template')
@section('content')
<title>Barang | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Item Data</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if( Session::get('masuk') !="")
            <div class='alert alert-success'><center><b>{{Session::get('masuk')}}</b></center></div>        
            @endif
            @if( Session::get('update') !="")
            <div class='alert alert-success'><center><b>{{Session::get('update')}}</b></center></div>        
            @endif
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-success" data-toggle="modal" data-target="#tambah">Add Data</button>
                </div>
            </div>
            <br>
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $i => $u)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$u->id_barang}}</td>
                        <td>{{$u->nama_barang}}</td>
                        <td>{{$u->nama_kategori}}</td>
                        <td>{{$u->jumlah_barang}}</td>
                        <td>{{$u->harga_barang}}</td>
                        <td>
                            <a href="/barang/edit/{{$u->id_barang}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-pen"></i></a>
                            <button type="button" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#confirmDeleteModal{{ $u->id_barang }}"><i class="fa fa-trash"></i></button>
                            <div class="modal fade" id="confirmDeleteModal{{ $u->id_barang }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure want to delete this item?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <form action="{{ url('/barang/delete/' . $u->id_barang) }}" method="post">
                                                @csrf
                                                @method('DELETE') 
                                                <button type="submit" class="btn btn-danger">Delete it</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="tambah" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Input Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    <form action="/barang/store" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Item Code</label>
            <input type="text" name="id_barang" class="form-control"  required>
        </div>
        <div class="form-group">
            <label for="">Item Name</label>
            <input type="text" name="nama_barang" class="form-control"  required>
        </div>
        <div class="form-group">
            <label for="">Category</label>
            <select name="kategori_id" id="" class="form-control">
                <option value="" disabled selected>Choose Category</option>
                @foreach($kategori as $k)
                    <option value="{{$k->id_kategori}}">{{$k->nama_kategori}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Total</label>
            <input type="text" name="jumlah_barang" class="form-control"  required>
        </div>
        <div class="form-group">
            <label for="">Price</label>
            <input type="text" name="harga_barang" class="form-control"  required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    </div>
    </div>
</div>
</div>
@endsection