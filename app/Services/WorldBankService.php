<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

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

            try {

                $response = Http::timeout(8)
                    ->connectTimeout(5)
                    ->get(
                        "https://api.worldbank.org/v2/country/{$countryCode}/indicator/{$indicator}",
                        [
                            'format' => 'json',
                            'per_page' => 50,
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
                        if (
                            isset($row['value']) &&
                            $row['value'] !== null &&
                            $row['value'] > 0
                        ) {
                            $value = $row['value'];
                            break;
                        }
                    }

                }

                $result[$key] = $value;

            } catch (Exception $e) {

                $result[$key] = null;

            }

        }

        return $result;
    }
}