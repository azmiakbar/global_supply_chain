<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [

            // =========================
            // ELEKTRONIK
            // =========================

            [
                'name' => 'Smartphone',
                'category' => 'Elektronik',
                'weight' => 0.3,
                'price' => 800.00,
                'supplier' => 'Samsung Electronics',
            ],

            [
                'name' => 'Laptop',
                'category' => 'Elektronik',
                'weight' => 2.5,
                'price' => 1200.00,
                'supplier' => 'ASUS',
            ],

            [
                'name' => 'Tablet',
                'category' => 'Elektronik',
                'weight' => 0.7,
                'price' => 600.00,
                'supplier' => 'Apple Inc.',
            ],

            [
                'name' => 'Smart TV',
                'category' => 'Elektronik',
                'weight' => 18.0,
                'price' => 1500.00,
                'supplier' => 'LG Electronics',
            ],

            [
                'name' => 'Semiconductor Chips',
                'category' => 'Elektronik',
                'weight' => 0.05,
                'price' => 200.00,
                'supplier' => 'TSMC',
            ],

            [
                'name' => 'Lithium Batteries',
                'category' => 'Elektronik',
                'weight' => 15.0,
                'price' => 3500.00,
                'supplier' => 'Panasonic',
            ],

            [
                'name' => 'Network Routers',
                'category' => 'Elektronik',
                'weight' => 2.0,
                'price' => 400.00,
                'supplier' => 'Cisco Systems',
            ],

            [
                'name' => 'Computer Servers',
                'category' => 'Elektronik',
                'weight' => 25.0,
                'price' => 8000.00,
                'supplier' => 'Dell Technologies',
            ],

            // =========================
            // PERTANIAN
            // =========================

            [
                'name' => 'Coffee Beans',
                'category' => 'Pertanian',
                'weight' => 50.0,
                'price' => 700.00,
                'supplier' => 'PT Perkebunan Nusantara',
            ],

            [
                'name' => 'Palm Oil',
                'category' => 'Pertanian',
                'weight' => 1000.0,
                'price' => 1200.00,
                'supplier' => 'Wilmar International',
            ],

            [
                'name' => 'Rice',
                'category' => 'Pertanian',
                'weight' => 1000.0,
                'price' => 800.00,
                'supplier' => 'Perum Bulog',
            ],

            [
                'name' => 'Cocoa Beans',
                'category' => 'Pertanian',
                'weight' => 50.0,
                'price' => 950.00,
                'supplier' => 'Barry Callebaut',
            ],

            [
                'name' => 'Natural Rubber',
                'category' => 'Pertanian',
                'weight' => 500.0,
                'price' => 1400.00,
                'supplier' => 'PT Bakrie Sumatera',
            ],

            [
                'name' => 'Tea Leaves',
                'category' => 'Pertanian',
                'weight' => 40.0,
                'price' => 500.00,
                'supplier' => 'SariWangi',
            ],

            [
                'name' => 'Corn',
                'category' => 'Pertanian',
                'weight' => 1000.0,
                'price' => 600.00,
                'supplier' => 'Cargill',
            ],

            [
                'name' => 'Spices',
                'category' => 'Pertanian',
                'weight' => 20.0,
                'price' => 1500.00,
                'supplier' => 'PT Indo Spice',
            ],

        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}