<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPasien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pasien', function (Blueprint $table) {
            $table->increments('id_pasien');
            $table->string('nama_pasien');
            $table->string('nama_KK');
            $table->string('nomor_ktp');
            $table->string('alamat')->nullable();
            $table->date('tgl_lahir');
            $table->string('nomor_kis');
            $table->string('agama');
            $table->string('jenis_kelamin');
            $table->string('pekerjaan')->nullable();
            $table->string('nomor_telp')->nullable();
            $table->string('status');
            $table->string('status_peserta');
            $table->string('faskes');
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
        Schema::dropIfExists('tbl_pasien');
    }
}
