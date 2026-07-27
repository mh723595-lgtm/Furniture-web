<?php

namespace Database\Seeders;

use App\Models\Showroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShowroomSeeder extends Seeder
{
    public function run(): void
    {
        $showrooms = [
            ['name' => 'Furnisha Jakarta Selatan', 'city' => 'Jakarta Selatan', 'province' => 'DKI Jakarta'],
            ['name' => 'Furnisha Bandung', 'city' => 'Bandung', 'province' => 'Jawa Barat'],
            ['name' => 'Furnisha Surabaya', 'city' => 'Surabaya', 'province' => 'Jawa Timur'],
        ];

        foreach ($showrooms as $item) {
            Showroom::firstOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'name' => $item['name'],
                    'address' => "Jl. Furniture Raya No. 1, {$item['city']}",
                    'city' => $item['city'],
                    'province' => $item['province'],
                    'whatsapp_number' => '6285761690400',
                    'phone_number' => '021-1234567',
                    'operational_hours' => 'Senin - Minggu, 09.00 - 20.00',
                    'is_active' => true,
                ]
            );
        }
    }
}
