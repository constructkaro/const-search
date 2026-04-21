<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestingService extends Model
{
    protected $table = 'testing_lab_agency_providers';

    protected $fillable = [
        'vendor_id',
        'company_name',
        'city_id',
        'area_ids',
        'minimum_project_value',
        'pincode',
        'services','team_size',
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
}