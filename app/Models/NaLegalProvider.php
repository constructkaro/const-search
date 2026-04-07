<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NaLegalProvider extends Model
{
    protected $fillable = [
        'services_offered',
        'property_types_handled',
        'complete_na_process',
        'legal_opinion_reports',
        'coordinate_with_advocates',
        'average_turnaround_time',
        'gst_certificate',
        'aadhar_card',
        'company_profile',
        'registration_license',
        'status',
    ];

    protected $casts = [
        'services_offered' => 'array',
        'property_types_handled' => 'array',
    ];
}