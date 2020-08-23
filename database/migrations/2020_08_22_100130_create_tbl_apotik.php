<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblApotik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_apotik', function (Blueprint $table) {
            $table->increments('id_apotik');
            $table->integer('id_pasien');
            $table->string('nama_obat');
            $table->integer('harga');
            $table->integer('stock');
            $table->integer('id_obat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_apotik');
    }
}
