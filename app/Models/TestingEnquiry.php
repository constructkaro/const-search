<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestingEnquiry extends Model
{
    protected $table = 'testing_enquiries';

    protected $fillable = [
        'service_name',
        'house_building_name',
        'road_area_colony',
        'city',
        'pincode',
        'project_name',
        'number_of_samples',
        'required_testing_type',
        'additional_details',
    ];
}