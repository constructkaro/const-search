<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FabricationServiceProvider extends Model
{
    protected $fillable = [
        'service_types',
        'service_models',
        'project_types_handled',
        'company_profile',
        'gst_certificate',
        'aadhaar_card',
        'udyam_certificate',
        'status',
    ];

    protected $casts = [
        'service_types' => 'array',
        'service_models' => 'array',
        'project_types_handled' => 'array',
    ];
}