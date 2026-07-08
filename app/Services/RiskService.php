<?php

namespace App\Services;

class RiskService
{
    public function calculate(
        ?array $weather,
        ?array $currency,
        ?array $economy,
        ?array $news = null
    ): array {

        $score = 0;

        /*
        |----------------------------------
        | WEATHER
        |----------------------------------
        */

        if ($weather) {

            if (($weather['rain'] ?? 0) >= 30) {
                $score += 30;
            }

            if (($weather['wind_speed_10m'] ?? 0) >= 50) {
                $score += 20;
            }

        }

        /*
        |----------------------------------
        | CURRENCY
        |----------------------------------
        */

        if ($currency) {

            if (($currency['rate'] ?? 0) > 1000) {
                $score += 10;
            }

        }

        /*
        |----------------------------------
        | ECONOMY
        |----------------------------------
        */

        if ($economy) {

            if (($economy['inflation'] ?? 0) > 5) {
                $score += 20;
            }

        }

        /*
        |----------------------------------
        | LEVEL
        |----------------------------------
        */

        if ($score >= 60) {

            $level = 'HIGH';

        } elseif ($score >= 30) {

            $level = 'MEDIUM';

        } else {

            $level = 'LOW';

        }

        return [

            'score' => $score,

            'level' => $level,

        ];
    }
}