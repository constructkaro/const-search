<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacadeServiceProvider extends Model
{
    protected $fillable = [
        'service_types',
        'service_models',
        'building_types',
        'company_profile',
        'gst_certificate',
        'aadhaar_card',
        'safety_certifications',
        'quality_certifications',
        'status',
    ];

    protected $casts = [
        'service_types' => 'array',
        'service_models' => 'array',
        'building_types' => 'array',
    ];
}