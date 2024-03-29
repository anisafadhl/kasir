@extends('layouts.template')
@section('content')
<title>Pasok | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Supply Quantity</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        @if( Session::get('masuk') !="")
            <div class='alert alert-success'><center><b>{{Session::get('masuk')}}</b></center></div>        
            @endif
            @if( Session::get('update') !="")
            <div class='alert alert-success'><center><b>{{Session::get('update')}}</b></center></div>        
            @endif
            <button class="btn btn-success" data-toggle="modal" data-target="#tambah">Add Data</button>
            <br>
            <br>
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Items</th>
                        <th>Supply Quantity</th>
                        <th>Supplier Name</th>
                        <th>Supply Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasok as $i => $u)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$u->nama_barang}}</td>
                        <td>{{$u->jumlah_pasok}}</td>
                        <td>{{$u->nama_pemasok}}</td>
                        <td>{{$u->tanggal_pasok}}</td>
                        <td><a href="/pasok/edit/{{ $u->id_pasok}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-pen"></i></a></td>
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
        <form action="/pasok/store" method="post">
            @csrf
          <div class="form-group">
             <div class="input_fields_wrap">
            <button class="add_field_button btn btn-primary">Add Fields</button>
            <table>
              <tr>
                <td>
                  <label for="">Item Name</label>
                  <br>
                      <select name="id_barang[]" id="" class="myselect form-control"  required>
                          <option selected disabled value="">Select Item Type</option>
                          @foreach ($barang as $j)
                          <option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>
                          @endforeach  
                    </select>
                    </div>
                </td>
                <td class="pl-4">
                  <label for="">Amount</label>
                <input type="number" name="jumlah[]" class="form-control" required placeholder="Enter Amount" required>
                </td>
              </tr>
            </table>
              
            </div>
            <div class="form-group">
                <label for="">Supplier Name</label>
                <input type="text" name="nama_pemasok" class="form-control" placeholder="Enter Supplier Name" required>
            </div>

            <div class="form-group">
                <label for="">Supply Date</label>
                <input type="date" name="tanggal_pasok" class="form-control" required>
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


@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var max_fields      = 100; //maximum input boxes allowed
        var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment


    $(wrapper).append('<div><table><tr><td><select name="id_barang[]" id="" class="myselect form-control" required><option selected disabled value="">Pilih Jenis Barang</option>@foreach ($barang as $j)<option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>@endforeach</select></div></td><td class="pl-4"><input type="number" name="jumlah[]" class="form-control" required placeholder="Masukan Jumlah" required></td></tr></table><a href="#" class="remove_field">Remove</a></div>');
    $('.myselect').select2();
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').remove(); x--;

    })
    $('.myselect').select2();
});

</script>
@endpush

@endsection