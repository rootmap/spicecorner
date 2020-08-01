<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DayWiseCategory extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='day_wise_categories';
}
        