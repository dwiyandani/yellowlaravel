<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    //
    protected $table = 'sky_position';
    protected $primaryKey = 'positionid';
    public $timestamps = false;
}
