<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRujukan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_rujukan', function (Blueprint $table) {
            $table->increments('id_rujukan');
            $table->string('nomor_rujukan');
            $table->date('tanggal');
            $table->string('asal')->nullable();
            $table->string('ke');
            $table->string('alamat_tujuan')->nullable();
            $table->integer('id_pasien');
            $table->integer('status')->default(0);
            $table->integer('id_poli');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('tbl_rujukan');
    }
}
