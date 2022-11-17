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
        Schema::create('request_produsen', function (Blueprint $table) {
            $table->id();
            $table->string('id_penjual');
            $table->string('id_produsen');
            $table->string('name_penjual');
            $table->string('name_produsen');
            $table->string('name_toko');
            $table->string('product_name');
            $table->string('email_produsen');
            $table->string('alamat_produsen');
            $table->string('alamat_penjual');
            $table->string('number_phone_penjual');
            $table->string('number_phone_produsen');
            $table->string('tanggal_pengambilan');
            $table->string('qty');
            $table->string('harga');
            $table->string('image_produsen');
            $table->string('image_penjual');
            $table->enum('status_penitipan', ['MENUNGGU', 'DITERIMA', 'DITOLAK', 'SELESAI'])->default('MENUNGGU')->nullable();
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
        Schema::dropIfExists('request_produsen');
    }
};
