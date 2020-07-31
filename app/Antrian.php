<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = "tbl_antrian";

    public $primaryKey = "id_antrian";

    public $guarded = [];

    public function kodefikasi()
    {
        return $this->hasOne('\App\Poli','id_poli','id_poli');
    }

}
