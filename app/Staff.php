<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $table = 'sky_staff';
    protected $primaryKey = 'staffid';
    public $timestamps = false;

    protected $guarded = ['staffid'];
    protected $fillable = ['staffno', 'staffname', 'dob', 'pob', 'gender', 'phone', 'addr', 'ktpno', 'photoktp', 'picfile', 'positionid', 'locationid', 'datestart', 'dateresign', 'sp1', 'password', 'admin', 'inactive'];
    // protected $attributes  = ['staffno' => false, 'staffname' => false, 'dob' => true, 'dop', 'gender', 'phone'=> true, 'addr', 'ktpno', 'photoktp', 'picfile', 'positionid', 'locationid', 'datestart', 'dateresign', 'sp1', 'password', 'admin', 'inactive'];
    // protected $attributes = [
    //     'dob' => false,
    //     'dop' => false,
    //     'phone' => false,
    //     'addr' => false,
    //     'ktpno' => false,
    //     'photoktp' => false,
    //     'picfile' => false,
    //     'datestart' => false,
    //     'dateresign' => false,
    //     'sp1' => false,
    //     'password' => false,
    //     'admin' => false,
    //     'inactive' => false
    // ];
}
