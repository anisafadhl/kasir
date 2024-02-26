<body>
    <p>Toko Cina Suka-Suka</p>
    <p>Jl. Raya Kebanjiran</p>
    <p>Cashier : {{$kasir->name}}</p>
    <p>Date :{{$ambil->tanggal_beli}}</p>
    <p>===================================</p>
    <table style="margin-top:-10px">
    @foreach($transaksi as $u)
        <tr>
            <td style="padding-right:50px">{{$u->nama_barang}}</td>
            <td style="padding-right:50px">{{$u->jumlah_beli}}</td>
            <td style="padding-right:50px">{{$u->harga_barang}}</td>
            <td style="padding-right:50px">{{$u->total_harga}}</td>
        </tr>
    @endforeach
        <tr>
            <td colspan="3" style="text-align:right;padding-right:50px">Total Price</td>
            <td>{{$jumlah}}</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right;padding-right:50px">Payment</td>
            <td>{{$kembalian->bayar}}</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right;padding-right:50px">Money Changes</td>
            <td>{{$kembalian->kembalian}}</td>
        </tr>
    </table>
    <p>===================================</p>
    <p>Thank you for shopping at our store <br>Have a nice day!</p>
</body>
