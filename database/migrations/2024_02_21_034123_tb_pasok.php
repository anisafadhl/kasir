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
        Schema::create('tb_pasok', function (Blueprint $table) {
            $table->integer('id_pasok')->autoIncrement();
            $table->string('barang_pasok_id')->nullable;
            $table->string('jumlah_pasok')->nullable;
            $table->string('nama_pemasok')->nullable;
            $table->date('tanggal_pasok')->nullable;
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
        Schema::dropIfExists('tb_pasok');
    }
};
