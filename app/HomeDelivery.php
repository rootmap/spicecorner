<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeDelivery extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='home_deliveries';
}
        