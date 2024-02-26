@extends('layouts.template')
@section('content')
<title>Barang | Kasir</title>
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
@if( Session::get('gagal') !="")
            <div class='alert alert-danger'><center><b>{{Session::get('gagal')}}</b></center></div>        
            @endif
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
        
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Transaction Input</h6>
            </div>
            <div class="card-body">
                <form action="/masuk/sementara" method="post">
                @csrf
                    <font color="blue">Transaction Code : {{$max_code}}</font>
                    <input type="hidden" name="kode_transaksi" value="{{$max_code}}">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Input Item Code</label>
                                <input type="text" id="id_barang" name="id_barang" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Item Name</label>
                            <input type="text" id="nama" readonly name="nama_barang"  class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Item Price</label>
                            <input type="number" id="harga" readonly name="harga" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Amount</label>
                            <input type="number" name="jumlah_beli" class="form-control" required>
                        </div>
                        <div class="col-md-12 mt-3">
                            <center><input type="submit" class="btn btn-success" value="Submit"></center>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Transaction Data</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th class="td">Item</th>
                        <th class="td">Amount</th>
                        <th class="td">Price</th>
                        <th class="td">Total</th>
                        <th class="td">Action</th>
                    </tr> 
                    @foreach($sementara as $u)
                    <tr>
                        <td class="td">{{$u->nama_barang}}</td>
                        <td class="td">{{$u->jumlah_beli}}</td>
                        <td class="td">{{$u->harga_barang}}</td>
                        <td class="td">{{$u->total_harga}}</td>
                        <td class="td">
                            <form action="{{ url('/nyokot2/delete/' . $sementara) }}" method="post">
                                @csrf
                                @method('DELETE') 
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    @endforeach
                    <tr>
                        {{-- <td class="td"></td> --}}
                        <td colspan="3" class="td" style="text-align:right">Total Price : </td>
                        <td class="td">{{$jumlah}}</td>
                        <input type="hidden" id="jumlah" value="{{$jumlah}}">
                        <td class="td"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Payment</h6>
            </div>
            <div class="card-body">
                <form action="/masuk/semua" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Pay</label>
                        <input type="hidden" name="kode_transaksi_kembalian" value="{{$max_code}}">
                        <input type="number" id="bayar" onkeyup="hitung2();" name="bayar" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Money Changes</label>
                        <input type="number" id="kembalian" name="kembalian" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    $('#country').change(function(){
    var kategoriID = $(this).val();    
    if(kategoriID){
        $.ajax({
           type:"GET",
           url:"{{url('ambil')}}?kategori_id="+kategoriID,
           success:function(res){               
            if(res){
                $("#state").empty();
                $("#state").append('<option></option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
       
    }      
   });

   $('#state').change(function(){
    var idbarang = $(this).val();    
    if(idbarang){
        $.ajax({
           type:"GET",
           url:"{{url('ambil2')}}?id_barang="+idbarang,
           success:function(res){               
            if(res){
                $("#harga").empty();
                $.each(res,function(key,value){
                    $("#harga").val(value);
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
       
    }      
   });

$('#id_barang').change(function(){
    setInterval(function(){ 
    if($('#id_barang').val()!=''){
        var id=$('#id_barang').val();
        $.ajax({
           type:"GET",
           url:"{{url('nyokot')}}?id_barang="+id,
           success:function(res){               
            if(res){
                $.each(res,function(key,value){
                    $("#harga").val(key);
                    $("#nama").val(value);
                });
            }else{
                $("#harga").empty();
                $("#nama").empty();
            }
           }
        });
    }
}, 500);
});

function hitung2() {
    var a = $("#jumlah").val();
    var b = $("#bayar").val();
    c = b - a; //a kali b
    $("#kembalian").val(c);
}

</script>
@endpush

@endsection