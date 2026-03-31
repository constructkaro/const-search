<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['pincode', 'city', 'state'];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'area_services')
                    ->withPivot('is_available');
    }
}