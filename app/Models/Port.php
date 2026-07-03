<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Port extends Model
{
    protected $fillable = [
        'country_id',
        'code',
        'name',
        'latitude',
        'longitude',
        'status',
        'transport_type',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}