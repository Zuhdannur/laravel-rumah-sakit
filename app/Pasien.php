<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = "tbl_pasien";

    public $primaryKey = "id_pasien";

    protected $guarded = [];

    public $dates = [
        "tgl_lahir"
    ];
}
