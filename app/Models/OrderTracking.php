<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTracking extends Model
{
    protected $fillable = [
        'customer_id',
        'service_key',
        'source_id',
        'source_table',
        'template_code',
        'status',
    ];

    public function steps()
    {
        return $this->hasMany(OrderTrackingStep::class)->orderBy('tab_type')->orderBy('step_order');
    }
}