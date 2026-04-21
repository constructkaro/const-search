<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyorProvider extends Model
{
    protected $table = 'surveyor_providers';

    protected $fillable = [
        'vendor_id',
        'project_types',
        'experience_years',
        'team_size',
        'pincode',
        'minimum_project_value',
        'city_id','area_ids','pincode',
        'company_name',
        'entity_type',
        'registered_address',
        'contact_person_name',
        'contact_person_designation',
        'licensed_surveyor',
        'stamped_drawings',
        'report_format_available',
        'land_record_support',
        'gst_certificate',
        'aadhaar_card',
        'company_profile',
        'license_certificate',
        'previous_project_photos',
        'pan_card',
        'status',
    ];

    protected $casts = [
    'project_types' => 'array',
    'area_ids' => 'array', // ✅ ADD THIS
];

    public function trackings()
    {
        return $this->morphMany(\App\Models\OrderTracking::class, 'trackable');
    }
}