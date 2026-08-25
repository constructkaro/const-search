<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstructionEducationPost extends Model
{
    protected $fillable = [
        'title',
        'image',
        'instagram_url',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
