<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Port;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PortSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/ports/unlocode.csv');

        if (!File::exists($path)) {
            $this->command->error('File unlocode.csv tidak ditemukan!');
            return;
        }

        $file = fopen($path, 'r');

        $header = fgetcsv($file);

        $count = 0;

        while (($row = fgetcsv($file)) !== false) {

            $data = array_combine($header, $row);

            $function = $data['Function'] ?? '';
            $coordinates = $data['Coordinates'] ?? '';

            /*
            |--------------------------------------------------------------------------
            | HANYA AMBIL SEA PORT (Function = 1)
            |--------------------------------------------------------------------------
            */

            if (!str_contains($function, '1')) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Harus punya koordinat
            |--------------------------------------------------------------------------
            */

            if (empty($coordinates)) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Cari negara
            |--------------------------------------------------------------------------
            */

            $country = Country::where('code', $data['Country'])->first();

            if (!$country) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Parse koordinat
            |--------------------------------------------------------------------------
            */

            [$latitude, $longitude] = $this->parseCoordinates($coordinates);

            /*
            |--------------------------------------------------------------------------
            | Simpan
            |--------------------------------------------------------------------------
            */

            Port::updateOrCreate(

                [
                    'code' => $data['Country'] . $data['Location']
                ],

                [

                    'country_id' => $country->id,

                    'name' => $data['Name'],

                    'latitude' => $latitude,

                    'longitude' => $longitude,

                    'status' => 'active',

                    'transport_type' => 'Sea',

                ]

            );

            $count++;
        }

        fclose($file);

        $this->command->info("Berhasil mengimpor {$count} Sea Ports.");
    }

    private function parseCoordinates(string $coordinates): array
    {
        preg_match(
            '/(\d{2})(\d{2})([NS])\s+(\d{3})(\d{2})([EW])/',
            $coordinates,
            $matches
        );

        if (count($matches) < 7) {
            return [0, 0];
        }

        $latitude = (int)$matches[1] + ((int)$matches[2] / 60);

        $longitude = (int)$matches[4] + ((int)$matches[5] / 60);

        if ($matches[3] === 'S') {
            $latitude *= -1;
        }

        if ($matches[6] === 'W') {
            $longitude *= -1;
        }

        return [$latitude, $longitude];
    }
}