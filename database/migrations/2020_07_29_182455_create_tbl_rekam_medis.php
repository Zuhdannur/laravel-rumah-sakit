<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRekamMedis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_rekam_medis', function (Blueprint $table) {
            $table->increments('id_rekam_medis');
            $table->integer('id_dokter');
            $table->integer('id_pasien');
            $table->string('nomor_pendaftaran');
            $table->datetime('tgl_periksa');
            $table->string('anemnesis');
            $table->string('periksa_fisik');
            $table->string('diagnosis');
            $table->string('plan');
            $table->integer('id_petugas');
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
        Schema::dropIfExists('tbl_rekam_medis');
    }
}
