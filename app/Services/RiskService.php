<?php

namespace App\Services;

class RiskService
{
    public function calculate(
        ?array $weather,
        ?array $currency,
        ?array $economy,
        array $news = []
    ): array {

        $weatherScore = 0;
        $currencyScore = 0;
        $economyScore = 0;
        $newsScore = 0;

        /*
        |--------------------------------------------------------------------------
        | WEATHER (Max 25)
        |--------------------------------------------------------------------------
        */

        if ($weather) {

            $rain = $weather['rain'] ?? 0;
            $wind = $weather['wind_speed_10m'] ?? 0;

            // Rain
            if ($rain >= 50) {
                $weatherScore += 15;
            } elseif ($rain >= 20) {
                $weatherScore += 10;
            } elseif ($rain >= 5) {
                $weatherScore += 5;
            }

            // Wind
            if ($wind >= 60) {
                $weatherScore += 10;
            } elseif ($wind >= 40) {
                $weatherScore += 7;
            } elseif ($wind >= 20) {
                $weatherScore += 5;
            }

        }

        /*
        |--------------------------------------------------------------------------
        | CURRENCY (Max 20)
        |--------------------------------------------------------------------------
        */

        if ($currency) {

            $rate = $currency['rate'] ?? 0;

            if ($rate >= 1000) {
                $currencyScore = 20;
            } elseif ($rate >= 500) {
                $currencyScore = 15;
            } elseif ($rate >= 100) {
                $currencyScore = 10;
            } elseif ($rate >= 10) {
                $currencyScore = 5;
            }

        }

        /*
        |--------------------------------------------------------------------------
        | ECONOMY (Max 25)
        |--------------------------------------------------------------------------
        */

        if ($economy) {

            $inflation = $economy['inflation'] ?? 0;

            if ($inflation >= 8) {
                $economyScore = 25;
            } elseif ($inflation >= 5) {
                $economyScore = 15;
            } elseif ($inflation >= 3) {
                $economyScore = 10;
            }

        }

        /*
        |--------------------------------------------------------------------------
        | NEWS (Max 30)
        |--------------------------------------------------------------------------
        */

        $keywords = [
            'earthquake',
            'flood',
            'storm',
            'war',
            'conflict',
            'strike',
            'protest',
            'disaster',
            'explosion',
            'attack',
            'terror',
            'sanction',
            'delay',
            'port',
            'shipping',
            'export',
            'import',
        ];

        foreach ($news as $article) {

            $text = strtolower(
                ($article['title'] ?? '') .
                ' ' .
                ($article['description'] ?? '')
            );

            foreach ($keywords as $keyword) {

                if (str_contains($text, $keyword)) {

                    $newsScore += 3;

                }

            }

        }

        if ($newsScore > 30) {
            $newsScore = 30;
        }

        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $total =
            $weatherScore +
            $currencyScore +
            $economyScore +
            $newsScore;

        /*
        |--------------------------------------------------------------------------
        | LEVEL
        |--------------------------------------------------------------------------
        */

        if ($total >= 71) {

            $level = 'HIGH';

        } elseif ($total >= 31) {

            $level = 'MEDIUM';

        } else {

            $level = 'LOW';

        }

        return [

            'weather' => $weatherScore,

            'currency' => $currencyScore,

            'economy' => $economyScore,

            'news' => $newsScore,

            'total' => $total,

            'level' => $level,

        ];

    }
}