<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyProjectPhoto extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'survey_provider_id',
        'photo_path',
        'created_at',
    ];

    public function surveyProvider()
    {
        return $this->belongsTo(SurveyProvider::class);
    }
}