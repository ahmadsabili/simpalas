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
        Schema::create('pembayaran_komite', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->references('id')->on('siswa');
            $table->string('kelas');
            $table->string('tahun_ajaran');
            $table->string('bulan');
            $table->bigInteger('nominal');
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
        Schema::dropIfExists('pembayaran_spps');
    }
};
