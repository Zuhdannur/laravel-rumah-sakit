<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apotik extends Model
{
    protected $table = "tbl_apotik";

    protected $guarded = [''];

    public $primaryKey = "id_apotik";

    public $timestamps = false;

    public function pasien() {
        return $this->hasOne('\App\Pasien','id_pasien','id_pasien');
    }

    public function jenis_obat() {
        return $this->hasOne('\App\Obat','id_obat','id_obat');
    }
}
