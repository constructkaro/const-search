<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'title',
        'work_subtype_id',
        'work_type_id',
        'state',
        'region',
        'city',
        'budget_id',
        'contact_name',
        'mobile',
        'email',
        'description',
        'area',
        'files',
        'contact_time',
        'post_verify',
        'get_vendor',
        'pincode',
        'unit_id',
    ];
}