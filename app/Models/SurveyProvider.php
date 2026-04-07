<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyProvider extends Model
{
    protected $fillable = [
        'survey_types',
        'licensed_certified',
        'stamped_drawings',
        'report_format_available',
        'land_record_support',
        'gst_certificate',
        'aadhar_card',
        'company_profile',
        'license_certificate',
        'status',
    ];

    protected $casts = [
        'survey_types' => 'array',
        'licensed_certified' => 'boolean',
        'stamped_drawings' => 'boolean',
        'report_format_available' => 'boolean',
        'land_record_support' => 'boolean',
    ];

    public function photos()
    {
        return $this->hasMany(SurveyProjectPhoto::class);
    }
}