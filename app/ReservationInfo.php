<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationInfo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='reservation_infos';
}
        