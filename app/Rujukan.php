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
}
