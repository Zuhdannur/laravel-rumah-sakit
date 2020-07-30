<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = "tbl_antrian";

    public $primaryKey = "id_antrian";

    public $guarded = [];

}
