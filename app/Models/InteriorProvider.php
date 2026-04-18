<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InteriorProvider extends Model
{
    protected $table = 'interior_providers';

    protected $fillable = [
        'vendor_id',
        'project_types',
        'experience_years',
        'team_size',
        'state',
        'region',
        'city',
        'pincode',
        'minimum_project_value',

        'company_name',
        'entity_type',
        'registered_address',
        'contact_person_name',
        'contact_person_designation',

        'pan_number',
        'gst_number',
        'specialization',
        'website',

        'pan_card',
        'gst_certificate',
        'company_profile',
        'supporting_documents',
        'portfolio_image_1',
        'portfolio_image_2',
        'portfolio_image_3',
    ];

    protected $casts = [
        'project_types' => 'array',
    ];

    public function trackings()
    {
        return $this->morphMany(\App\Models\OrderTracking::class, 'trackable');
    }
}