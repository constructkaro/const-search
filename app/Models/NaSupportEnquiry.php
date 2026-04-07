<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaSupportEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_name',
        'road_name',
        'city',
        'pincode',
        'project_name',
        'land_status',
        'project_area',
        'project_area_unit',
        'complete_na_process',
        'legal_opinion_report',
        'advocate_coordinate',
        'additional_details',
    ];
}