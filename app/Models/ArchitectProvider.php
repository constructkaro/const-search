<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchitectProvider extends Model
{
    protected $table='architect_providers';
    protected $fillable = [
        'vendor_id',
        'project_types',
        'experience_years',
        'team_size',
        // 'state',
        'aadhaar_card',
        'city',
        'minimum_project_value',
        'company_name',
        'entity_type',
        'registered_address',
        'contact_person_name',
        'contact_person_designation',
        'pan_number',
        'tan_number',
        // 'gst_number',
        // 'coa_number',
        // 'website',
        'pan_card',
        'gst_certificate',
        'esic_number',
        'pf_number',
        'coa_certificate',
        'msme_registered',
        'company_profile',
        'portfolio_image_1',
        'portfolio_image_2',
        'portfolio_image_3',
        'msme_certificate',
        'status',
    ];

    protected $casts = [
        'project_types' => 'array',
    ];
}