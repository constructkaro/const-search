<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacadeEnquiry extends Model
{
    protected $fillable = [
        'facade_type',
        'house_building_name',
        'road_area_colony',
        'city',
        'pincode',
        'project_name',
        'glass_facade_type',
        'project_area',
        'building_type',
        'service_scope',
        'additional_details',
    ];
}