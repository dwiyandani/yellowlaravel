<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    //
    protected $table = 'sky_location';
    protected $primaryKey = 'locationid';
    public $timestamps = false;
}
