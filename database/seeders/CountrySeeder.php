<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/countries_raw.json');

        $countries = json_decode(
            file_get_contents($path),
            true
        );

        foreach ($countries as $country) {

            Country::updateOrCreate(

                ['code' => $country['cca2']],

                [

                    'name' => $country['name']['common'],

                    'code' => $country['cca2'],

                    'capital' => !empty($country['capital'])
                        ? $country['capital'][0]
                        : 'Unknown',

                    'latitude' => $country['latlng'][0] ?? null,

                    'longitude' => $country['latlng'][1] ?? null,

                    'currency' => !empty($country['currencies'])
                        ? array_key_first($country['currencies'])
                        : 'N/A',

                    'language' => !empty($country['languages'])
                        ? array_values($country['languages'])[0]
                        : 'Unknown',

                    'region' => $country['region'],

                    'population' => $country['population'] ?? 0,

                    'flag' => $country['flag'] ?? '🏳️',

                ]

            );

        }
    }
}