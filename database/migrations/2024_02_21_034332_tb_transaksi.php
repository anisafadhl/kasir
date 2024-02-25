<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->integer('id_transaksi')->autoIncrement();
            $table->string('kode_transaksi')->nullable;
            $table->string('barang_id')->nullable;
            $table->string('jumlah_beli')->nullable;
            $table->string('total_harga')->nullable;
            $table->string('pengguna_id')->nullable;
            $table->date('tanggal_beli')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_transaksi');
    }
};
