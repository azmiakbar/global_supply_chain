<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyService
{
    public function latest(string $currency): ?array
    {
        $response = Http::get(
            "https://open.er-api.com/v6/latest/USD"
        );

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();

        if (!isset($data['rates'][$currency])) {
            return null;
        }

        return [
            'base' => 'USD',
            'currency' => $currency,
            'rate' => $data['rates'][$currency],
            'updated' => $data['time_last_update_utc'] ?? null,
        ];
    }
}