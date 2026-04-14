<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTrackingStep extends Model
{
    protected $fillable = [
        'order_tracking_id',
        'template_id',
        'service_key',
        'template_code',
        'tab_type',
        'step_order',
        'step_title',
        'step_description',
        'step_type',
        'status',
        'button_text',
        'input_value',
        'extra_data',
    ];

    protected $casts = [
        'extra_data' => 'array',
    ];

    public function tracking()
    {
        return $this->belongsTo(OrderTracking::class, 'order_tracking_id');
    }
}