<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineryProviderItem extends Model
{
    protected $fillable = [
        'machinery_provider_id',
        'brand',
        'model',
        'quantity',
        'capacity',
    ];

    public function provider()
    {
        return $this->belongsTo(MachineryProvider::class, 'machinery_provider_id');
    }
}