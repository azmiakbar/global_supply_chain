<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsAnalysis extends Model
{
    protected $fillable = [
        'country',
        'source',
        'title',
        'description',
        'image',
        'url',
        'published_at',
        'sentiment',
        'category',
    ];
}