<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBoqProfile extends Model
{
    protected $fillable = [
        'vendor_id',
        'project_types_handled',
        'boq_turnaround_time',
        'gst_certificate',
        'aadhar_card',
        'company_profile',
    ];

    protected $casts = [
        'project_types_handled' => 'array',
    ];
}