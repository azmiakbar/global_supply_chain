<?php

namespace App\Services;

class DistanceService
{
    const EARTH_RADIUS = 6371;

    public function calculate(
        float $lat1,
        float $lon1,
        float $lat2,
        float $lon2
    ): float {

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);

        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        $a =
            sin($dLat / 2) * sin($dLat / 2) +
            cos($lat1) *
            cos($lat2) *
            sin($dLon / 2) *
            sin($dLon / 2);

        $c = 2 * atan2(
            sqrt($a),
            sqrt(1 - $a)
        );

        return self::EARTH_RADIUS * $c;
    }
}