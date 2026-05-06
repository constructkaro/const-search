<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBoqProfile extends Model
{
    protected $table = 'boq_providers';

    protected $fillable = [
        'vendor_id',
        'project_types',
        'experience_years',
        'team_size',
        'city_ids',
        'area_ids',
        'pincode',
        'minimum_project_value',
        'boq_turnaround_time',
        'gst_certificate',
        'aadhar_card',
        'company_profile',
        'agreement_terms_accepted',
        'privacy_policy_accepted',
        'newsletter_opt_in',
        'agreement_accepted_at',
    ];

    protected $casts = [
        'project_types' => 'array',
        'city_ids' => 'array',
        'area_ids' => 'array',
        'agreement_terms_accepted' => 'boolean',
        'privacy_policy_accepted' => 'boolean',
        'newsletter_opt_in' => 'boolean',
    ];
}