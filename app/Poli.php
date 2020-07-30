<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = "tbl_poli";
    public $primaryKey = "id_poli";

    protected $guarded = [''];
}
