<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StructuralAuditProvider extends Model
{
    protected $fillable = [
        'vendor_id',
        'asset_types',
        'structure_types',
        'audit_types',
        'deliverables',
        'city_ids',
        'area_ids',
        'pincode',
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
        'company_name',
        'registered_address',
        'major_cities_covered',
        'agreement_terms_accepted',
        'privacy_policy_accepted',
        'newsletter_opt_in',
        'agreement_accepted_at',
        'status',
    ];

    protected $casts = [
        // Arrays — Laravel handles json_encode/decode automatically
        'asset_types'     => 'array',
        'structure_types' => 'array',
        'audit_types'     => 'array',
        'deliverables'    => 'array',
        'city_ids'        => 'array',
        'area_ids'        => 'array',

        // Booleans
        'available_for_emergency_inspection' => 'boolean',
        'available_for_site_visit'           => 'boolean',
        'msme_udyam_registered'              => 'boolean',
    ];

    protected $attributes = [
        'status'                             => 'pending',
        'available_for_emergency_inspection' => false,
        'available_for_site_visit'           => false,
        'msme_udyam_registered'              => false,
    ];

    public function vendor()
    {
        return $this->belongsTo(\App\Models\User::class, 'vendor_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
