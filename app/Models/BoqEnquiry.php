<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoqEnquiry extends Model
{
    protected $fillable = [
        'package_name',
        'house_building_name',
        'road_area_colony',
        'city',
        'pincode',
        'project_name',
        'no_of_floors',
        'project_area',
        'unit',
        'project_type',
        'service_required',
        'scope_of_work_required',
        'drawing_availability',
        'drawing_file',
        'additional_details',
    ];
}