<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rujukan extends Model
{
    protected $table = "tbl_rujukan";

    protected $guarded = [''];

    public $primaryKey = "id_rujukan";

    public $timestamps = false;

    public function pasien() {
        return $this->hasOne('\App\Pasien','id_pasien','id_pasien');
    }

    public function rekam_medis() {
        return $this->hasOne('\App\RekamMedis','id_rekam_medis','id_rekam_medis');
    }

    public function poli() {
        return $this->hasOne('\App\Poli','id_poli','id_poli');
    }
}
