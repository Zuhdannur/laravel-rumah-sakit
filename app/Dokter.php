<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = "tbl_dokter";

    public $primaryKey = "id_dokter";

    protected $guarded = [];

    public $dates = [
        "tgl_lahir"
    ];
}
