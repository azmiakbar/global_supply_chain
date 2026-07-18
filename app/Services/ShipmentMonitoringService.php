<?php

namespace App\Services;

class ShipmentMonitoringService
{
    public function generate(array $risk, int $baseEta): array
    {
        $delay = 0;

        $recommendation = 'Shipment can proceed normally.';

        if ($risk['level'] === 'HIGH') {

            $delay = 5;

            $recommendation =
                'High operational risk detected. Consider delaying shipment.';

        }

        elseif ($risk['level'] === 'MEDIUM') {

            $delay = 2;

            $recommendation =
                'Monitor shipment closely during transit.';

        }

        return [

            'base_eta' => $baseEta,

            'delay_days' => $delay,

            'final_eta' => $baseEta + $delay,

            'recommendation' => $recommendation,

        ];
    }
}