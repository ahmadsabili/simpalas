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
        Schema::create('pembayaran_buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->references('id')->on('siswa');
            $table->string('kelas');
            $table->foreignId('id_buku')->references('id')->on('buku');
            $table->bigInteger('nominal');
            $table->enum('status', ['Dibayar', 'Belum Dibayar'])->default('Belum Dibayar');
            $table->timestamp('tanggal_bayar')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran_buku');
    }
};
