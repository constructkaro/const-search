<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'content_blocks',
        'image',
        'hero_image',
        'hero_image_fit',
        'hero_image_height',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'content_blocks' => 'array',
        'published_at' => 'date',
        'is_published' => 'boolean',
    ];
}
