<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table='vendor_register';
    protected $fillable = [
        'full_name',
        'mobile',
        'email','company_name','city','business_address','business_entity','pincode'
    ];
}