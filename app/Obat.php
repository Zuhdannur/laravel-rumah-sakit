<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = "tbl_obat";

    protected $guarded = [''];

    public $primaryKey = "id_obat";

    public $timestamps = false;
}
