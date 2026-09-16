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
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'boolean',
    ];
}
