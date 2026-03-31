<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaService extends Model
{
    protected $fillable = ['area_id', 'service_id', 'is_available'];
}
