<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    protected $fillable = [
        'item_id',
        'origin_country_id',
        'destination_country_id',
        'origin_port_id',
        'destination_port_id',
        'quantity',
        'transport_type',
        'departure_date',
        'estimated_arrival',
        'status',
        'risk_level',
        'risk_score',
        'estimated_days',
        'delay_days',
        'actual_estimated_arrival',
        'last_monitoring',
        'latest_information',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'estimated_arrival' => 'date',
        'actual_estimated_arrival' => 'date',
        'last_monitoring' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function originCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'origin_country_id');
    }

    public function destinationCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'destination_country_id');
    }

    public function originPort(): BelongsTo
    {
        return $this->belongsTo(Port::class, 'origin_port_id');
    }

    public function destinationPort(): BelongsTo
    {
        return $this->belongsTo(Port::class, 'destination_port_id');
    }

    /*
    |--------------------------------------------------------------------------
    | AUTO STATUS
    |--------------------------------------------------------------------------
    */

    public function getCurrentStatusAttribute()
    {
        $today = Carbon::today();

        $departure = Carbon::parse($this->departure_date);

        $arrival = Carbon::parse($this->actual_estimated_arrival);

        if ($today->lt($departure)) {

            return 'Pending';

        }

        if ($today->lt($arrival)) {

            return 'In Transit';

        }

        return 'Delivered';
    }
}