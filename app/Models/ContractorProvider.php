<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractorProvider extends Model
{
    protected $table ='contractor_providers';
    protected $fillable = [
        'customerId',
        'project_types',
        'experience_years',
        'team_size',
        'city',
        'minimum_project_value',
        'company_name',
        'entity_type',
        'registered_address',
        'contact_person_designation',
        'contact_person_name',
        'pan_number',
        'pincode',
        'tan_number',
        'esic_number',
        'pf_number',
        'msme_registered',
        'msme_certificate',
        'pan_card',
        'gst_certificate',
        'aadhaar_card',
        'company_profile',
        'pf_doc',
        'esic_doc',
        'work_photo_1',
        'work_photo_2',
        'work_photo_3',
        'status',
    ];

    protected $casts = [
        'project_types' => 'array',
    ];

    public function trackings()
    {
        return $this->morphMany(\App\Models\OrderTracking::class, 'trackable');
    }
}