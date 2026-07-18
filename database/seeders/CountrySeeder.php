<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $population = collect(json_decode(file_get_contents(database_path('data/country-by-population.json')), true))
            ->keyBy('country');

        $capital = collect(json_decode(file_get_contents(database_path('data/country-by-capital-city.json')), true))
            ->keyBy('country');

        $currency = collect(json_decode(file_get_contents(database_path('data/country-by-currency-code.json')), true))
            ->keyBy('country');

        $language = collect(json_decode(file_get_contents(database_path('data/country-by-languages.json')), true))
            ->keyBy('country');

        $geo = collect(json_decode(file_get_contents(database_path('data/country-by-geo-coordinates.json')), true))
            ->keyBy('country');

        $countries = Country::all();

        foreach ($countries as $country) {

            $name = $this->normalizeCountryName($country->name);

            $pop = $population->get($name);

            $cap = $capital->get($name);

            $cur = $currency->get($name);

            $lang = $language->get($name);

            $loc = $geo->get($name);

            $country->population = $pop['population'] ?? 0;

            $country->capital = $cap['city'] ?? $country->capital;

            $country->currency = $cur['currency_code'] ?? $country->currency;

            $country->language = isset($lang['languages'])
                ? implode(', ', array_slice($lang['languages'], 0, 5))
                : $country->language;

            $country->latitude = isset($loc['north']) && isset($loc['south'])
                ? (($loc['north'] + $loc['south']) / 2)
                : $country->latitude;

            $country->longitude = isset($loc['east']) && isset($loc['west'])
                ? (($loc['east'] + $loc['west']) / 2)
                : $country->longitude;

            $country->save();

        }
    }

    private function normalizeCountryName(string $name): string
    {
        $map = [
            'Cabo Verde' => 'Cape Verde',

            "Côte d'Ivoire" => 'Ivory Coast',

            'Timor-Leste' => 'East Timor',

            'United States' => 'United States of America',

            'Russia' => 'Russian Federation',

            'South Korea' => 'Korea',

            'North Korea' => "Korea (Democratic People's Republic of)",

            'Czechia' => 'Czech Republic',

            'Eswatini' => 'Swaziland',

            'Myanmar' => 'Burma',

            'Palestine' => 'Palestine',

            'Vatican City' => 'Holy See (Vatican City State)',

            'Brunei Darussalam' => 'Brunei',

            'Republic of the Congo' => 'Congo',

            'Democratic Republic of the Congo'
                => 'Congo, The Democratic Republic of the',

            'Moldova' => 'Moldova, Republic of',

            'Iran' => 'Iran, Islamic Republic of',

            'Syria' => 'Syrian Arab Republic',

            'Laos' => "Lao People's Democratic Republic",

            'Bolivia' => 'Bolivia',

            'Tanzania' => 'Tanzania, United Republic of',

            'Venezuela' => 'Venezuela, Bolivarian Republic of',

            'Micronesia' => 'Micronesia, Federated States of',

            'Vietnam' => 'Viet Nam',

            'Macau' => 'Macao',
            
        ];
        
        return $map[$name] ?? $name;
    }
}