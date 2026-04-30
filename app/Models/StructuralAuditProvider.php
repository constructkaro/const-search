<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StructuralAuditProvider extends Model
{
    /*
     * DB table: structural_audit_providers
     *
     * Fillable columns (matches exactly what the controller assigns):
     *   vendor_id, asset_types, structure_types, audit_types, deliverables,
     *   team_size, minimum_project_value,
     *   available_for_emergency_inspection, available_for_site_visit, msme_udyam_registered,
     *   gst_number, pan_number,
     *   certificate_file, company_profile_file, logo_file,
     *   service_description, major_cities_covered, status
     */

    protected $fillable = [
        'vendor_id',
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
        'service_description','company_name',
        'major_cities_covered','agreement_terms_accepted','privacy_policy_accepted','newsletter_opt_in','agreement_accepted_at',
        'status',
    ];

    /*
     * Eloquent casts
     * ──────────────────────────────────────────────────────────────────
     * 'array' cast: Eloquent automatically calls json_encode() on save
     * and json_decode() on retrieval.
     *
     * IMPORTANT: Because these are cast as 'array', the controller must
     * assign the raw PHP array directly (e.g. $provider->asset_types = $request->asset_types)
     * and must NOT call json_encode() manually — that would double-encode
     * the data and store "[\"foo\",\"bar\"]" instead of ["foo","bar"].
     *
     * The four JSON columns in the DB are declared as longtext, which is
     * perfectly compatible with Eloquent's array cast.
     */
    protected $casts = [
        'asset_types'     => 'array',
        'structure_types' => 'array',
        'audit_types'     => 'array',
        'deliverables'    => 'array',

        // tinyint(1) columns → PHP bool
        'available_for_emergency_inspection' => 'boolean',
        'available_for_site_visit'           => 'boolean',
        'msme_udyam_registered'              => 'boolean',
    ];

    /*
     * Default values so new instances always have a sensible status.
     */
    protected $attributes = [
        'status'                             => 'pending',
        'available_for_emergency_inspection' => false,
        'available_for_site_visit'           => false,
        'msme_udyam_registered'              => false,
    ];

    /* ── Relationships (add as needed) ─────────────────────────────── */

    /**
     * The vendor (user) who submitted this profile.
     */
    public function vendor()
    {
        return $this->belongsTo(\App\Models\User::class, 'vendor_id');
    }

    /* ── Scopes ─────────────────────────────────────────────────────── */

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}