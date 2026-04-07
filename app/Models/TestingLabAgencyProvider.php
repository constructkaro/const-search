<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestingLabAgencyProvider extends Model
{
    protected $fillable = [
        'company_name',
        'city',
        'services',
        'lab_type',
        'certification',
        'service_mode',
        'sample_pickup_available',
        'gst_certificate',
        'aadhaar_card',
        'company_profile',
        'nabl_certificate',
        'lab_photos',
        'accreditation_certificate',
        'status',
    ];

    protected $casts = [
        'services' => 'array',
        'service_mode' => 'array',
        'lab_photos' => 'array',
        'sample_pickup_available' => 'boolean',
    ];
}