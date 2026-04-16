<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpCenterCallback extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'city',
        'area',
        'pincode',
    ];
}