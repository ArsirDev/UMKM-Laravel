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
        Schema::create('laporan_penjual', function (Blueprint $table) {
            $table->id();
            $table->string('produsen_name');
            $table->string('penjual_name');
            $table->string('product_name');
            $table->string('name_toko');
            $table->string('qty');
            $table->string('harga');
            $table->string('sisa_product');
            $table->string('laku_product');
            $table->string('barang_rusak');
            $table->string('expired');
            $table->string('tanggal_nitip');
            $table->string('tanggal_pengambilan');
            $table->enum('status', ['MENUNGGU', 'DITERIMA', 'DITOLAK', 'SELESAI'])->default('MENUNGGU');
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
        Schema::dropIfExists('laporan_penjual');
    }
};
