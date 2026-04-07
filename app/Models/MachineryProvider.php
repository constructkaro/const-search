<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineryProvider extends Model
{
    protected $fillable = [
        'machinery_categories',
        'operator_available',
        'breakdown_support',
        'night_shift_support',
        'availability_24x7',
        'rental_basis',
        'minimum_rental_duration',
        'gst_certificate',
        'aadhaar_card',
        'company_profile',
        'insurance_file',
        'ownership_proof',
        'machinery_photos',
        'status',
    ];

    protected $casts = [
        'machinery_categories' => 'array',
        'operator_available' => 'boolean',
        'breakdown_support' => 'boolean',
        'night_shift_support' => 'boolean',
        'availability_24x7' => 'boolean',
        'rental_basis' => 'array',
    ];

    public function items()
    {
        return $this->hasMany(MachineryProviderItem::class);
    }
}