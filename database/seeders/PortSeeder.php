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

        // Ambil header CSV
        $header = fgetcsv($file);

        $count = 0;

        while (($row = fgetcsv($file)) !== false) {

            $data = array_combine($header, $row);

            $function = $data['Function'] ?? '';
            $coordinates = $data['Coordinates'] ?? '';

            // Hanya ambil data yang punya fungsi:
            // 1 = Seaport
            // 4 = Airport
            // 6 = Dry Port
            if (
                !str_contains($function, '1') &&
                !str_contains($function, '4') &&
                !str_contains($function, '6')
            ) {
                continue;
            }

            // Harus punya koordinat
            if (empty($coordinates)) {
                continue;
            }

            // Cari negara berdasarkan kode ISO
            $country = Country::where('code', $data['Country'])->first();

            if (!$country) {
                continue;
            }

            // Tentukan jenis transportasi
            if (str_starts_with($function, '1')) {
                $transportType = 'seaport';
            } elseif (isset($function[3]) && $function[3] === '4') {
                $transportType = 'airport';
            } elseif (str_contains($function, '6')) {
                $transportType = 'dry_port';
            } else {
                continue;
            }

            // Parse koordinat
            [$latitude, $longitude] = $this->parseCoordinates($coordinates);

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
                    'transport_type' => $transportType,
                ]
            );

            $count++;
        }

        fclose($file);

        $this->command->info("Berhasil mengimpor {$count} logistics nodes.");
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