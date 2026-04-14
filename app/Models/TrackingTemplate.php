<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingTemplate extends Model
{
    protected $fillable = [
        'service_key',
        'template_code',
        'template_name',
        'tab_type',
        'step_order',
        'step_title',
        'step_description',
        'step_type',
        'status_default',
        'button_text',
    ];
}