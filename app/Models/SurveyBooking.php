<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyBooking extends Model
{
    protected $fillable = [
        'customer_id',
        'service_name',
        'package_name',
        'full_name',
        'mobile',
        'email',
        'full_address',
        'land_area',
        'area_unit',
        'description',
    ];
}