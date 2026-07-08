<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WorldBankService
{
    public function economy(string $countryCode): array
    {
        $countryCode = strtolower($countryCode);

        $indicators = [
            'gdp'        => 'NY.GDP.MKTP.CD',
            'inflation' => 'FP.CPI.TOTL.ZG',
            'exports'   => 'NE.EXP.GNFS.CD',
            'imports'   => 'NE.IMP.GNFS.CD',
        ];

        $result = [];

        foreach ($indicators as $key => $indicator) {

            $response = Http::get(
                "https://api.worldbank.org/v2/country/{$countryCode}/indicator/{$indicator}",
                [
                    'format' => 'json',
                    'per_page' => 5,
                ]
            );

            if (!$response->successful()) {
                $result[$key] = null;
                continue;
            }

            $json = $response->json();

            $value = null;

            if (isset($json[1])) {

                foreach ($json[1] as $row) {

                    if (!is_null($row['value'])) {
                        $value = $row['value'];
                        break;
                    }

                }

            }

            $result[$key] = $value;

        }

        return $result;
    }
}