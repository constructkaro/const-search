<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyorProvider extends Model
{
    protected $fillable = [
        'survey_types',
        'experience_years',
        'team_size',
        'state',
        'region',
        'city',
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
        'status',
    ];

    protected $casts = [
        'survey_types' => 'array',
    ];

 public function trackings()
{
    return $this->morphMany(\App\Models\OrderTracking::class, 'trackable');
}
}