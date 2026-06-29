<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
        'currency',
        'language',
        'region',
        'population',
        'flag',
    ];

    public function ports(): HasMany
    {
        return $this->hasMany(Port::class);
    }
}