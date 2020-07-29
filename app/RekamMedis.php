<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = "tbl_rekam_medis";
    public $primaryKey = "id_rekam_medis";

    protected $guarded = [];

    public function dokter() {
        return $this->hasOne('\App\Dokter','id_dokter','id_dokter');
    }

    public function pasien() {
        return $this->hasOne('\App\Pasien','id_pasien','id_pasien');
    }

    public function petugas() {
        return $this->hasOne('\App\User','id','id_petugas');
    }
}
