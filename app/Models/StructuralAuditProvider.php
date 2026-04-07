<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StructuralAuditProvider extends Model
{
    protected $fillable = [
        'asset_types',
        'structure_types',
        'audit_types',
        'deliverables',
        'team_size',
        'minimum_project_value',
        'available_for_emergency_inspection',
        'available_for_site_visit',
        'msme_udyam_registered',
        'gst_number',
        'pan_number',
        'certificate_file',
        'company_profile_file',
        'logo_file',
        'service_description',
        'major_cities_covered',
        'status',
    ];

    protected $casts = [
        'asset_types' => 'array',
        'structure_types' => 'array',
        'audit_types' => 'array',
        'deliverables' => 'array',
        'available_for_emergency_inspection' => 'boolean',
        'available_for_site_visit' => 'boolean',
        'msme_udyam_registered' => 'boolean',
    ];
}