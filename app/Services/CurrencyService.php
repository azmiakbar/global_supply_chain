<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyService
{
    public function latest(?string $currencyCode = null): ?array
    {
        $response = Http::timeout(10)
            ->get('https://open.er-api.com/v6/latest/USD');

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();

        if ($currencyCode === null) {
            return $data;
        }

        return [

            'code' => $currencyCode,

            'rate' => $data['rates'][$currencyCode] ?? null,

        ];
    }
}