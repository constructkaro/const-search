<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name'];

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'area_services')
                    ->withPivot('is_available');
    }
}