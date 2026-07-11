<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NewsService
{
    public function latest(string $country): array
    {
        $response = Http::get(
            'https://gnews.io/api/v4/search',
            [
                'q' => $country,
                'lang' => 'en',
                'max' => 5,
                'apikey' => config('services.gnews.api_key'),
            ]
        );

        if (!$response->successful()) {
            return [];
        }

        return $response->json()['articles'] ?? [];
    }
}