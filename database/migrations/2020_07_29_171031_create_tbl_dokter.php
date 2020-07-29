<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDokter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dokter', function (Blueprint $table) {
            $table->increments('id_dokter');
            $table->string('nama_dokter');
            $table->string('nip');
            $table->string('nomor_ktp');
            $table->string('tgl_lahir');
            $table->string('alamat');
            $table->string('agama');
            $table->string('jenis_kelamin');
            $table->string('nomor_telp');
            $table->string('spesialis');
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
        Schema::dropIfExists('tbl_dokter');
    }
}
