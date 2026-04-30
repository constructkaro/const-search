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
        'city_ids','area_ids','pincode',
        'company_name',
        'entity_type',
        'registered_address',
        'contact_person_name',
        'contact_person_designation',
       'agreement_terms_accepted',
'privacy_policy_accepted',
'newsletter_opt_in',
'agreement_accepted_at',
        'gst_certificate',
        'aadhaar_card',
        'company_profile',
        // 'license_certificate',
        // 'previous_project_photos',
        'pan_card',
        // 'status',
    ];

    protected $casts = [
    'project_types' => 'array',
    
    'city_ids' => 'array',
    'area_ids' => 'array', // ✅ ADD THIS
];

    public function trackings()
    {
        return $this->morphMany(\App\Models\OrderTracking::class, 'trackable');
    }
}