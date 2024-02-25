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
        Schema::create('tb_kembalian', function (Blueprint $table) {
            $table->integer('id_kembalian')->autoIncrement();
            $table->string('kode_transaksi_kembalian')->nullable;
            $table->string('bayar')->nullable;
            $table->string('kembalian')->nullable;
            $table->date('tanggal_transaksi')->nullable;
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
        Schema::dropIfExists('tb_kembalian');
    }
};
