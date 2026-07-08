<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function current(float $latitude, float $longitude): ?array
    {
        $response = Http::get(
            'https://api.open-meteo.com/v1/forecast',
            [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'current' => 'temperature_2m,relative_humidity_2m,rain,wind_speed_10m',
            ]
        );

        if (!$response->successful()) {
            return null;
        }

        return $response->json()['current'] ?? null;
    }
}