<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Sofa & Kursi Ruang Tamu',
            'Meja Makan',
            'Tempat Tidur',
            'Lemari Pakaian',
            'Rak & Storage',
            'Meja Kerja',
            'Kursi Makan',
            'Dekorasi Rumah',
        ];

        foreach ($categories as $index => $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => "Koleksi {$name} premium untuk rumah Anda.",
                    'sort_order' => $index,
                    'is_active' => true,
                    'meta_title' => $name,
                    'meta_description' => "Jelajahi koleksi {$name} premium berkualitas tinggi.",
                ]
            );
        }
    }
}
