<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::firstOrCreate(['title' => 'Furniture Premium untuk Rumah Impian Anda'], [
            'subtitle' => 'Desain hangat, material terbaik, kualitas terjamin untuk keluarga Indonesia.',
            'image_path' => 'banners/placeholder-hero.jpg',
            'button_text' => 'Lihat Katalog',
            'button_link' => '/katalog',
            'sort_order' => 1,
            'is_active' => true,
        ]);
    }
}
