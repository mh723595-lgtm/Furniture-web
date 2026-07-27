<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Sofa Minimalis Kayu Jati 3 Dudukan', 'category' => 'Sofa & Kursi Ruang Tamu', 'price' => 4500000, 'material' => 'Kayu Jati', 'color' => 'Coklat Tua'],
            ['name' => 'Sofa Bed Multifungsi', 'category' => 'Sofa & Kursi Ruang Tamu', 'price' => 3200000, 'material' => 'Kayu Mahoni', 'color' => 'Krem'],
            ['name' => 'Meja Makan Set 6 Kursi', 'category' => 'Meja Makan', 'price' => 6500000, 'material' => 'Kayu Jati Solid', 'color' => 'Natural'],
            ['name' => 'Meja Makan Bulat Kayu', 'category' => 'Meja Makan', 'price' => 3800000, 'material' => 'Kayu Mahoni', 'color' => 'Coklat'],
            ['name' => 'Tempat Tidur Minimalis Ukuran King', 'category' => 'Tempat Tidur', 'price' => 5200000, 'material' => 'Kayu Jati', 'color' => 'Natural Wood'],
            ['name' => 'Tempat Tidur Anak dengan Laci', 'category' => 'Tempat Tidur', 'price' => 2900000, 'material' => 'Particle Board', 'color' => 'Putih'],
            ['name' => 'Lemari Pakaian 3 Pintu', 'category' => 'Lemari Pakaian', 'price' => 4200000, 'material' => 'Kayu MDF', 'color' => 'Coklat Muda'],
            ['name' => 'Lemari Pakaian Sliding Door', 'category' => 'Lemari Pakaian', 'price' => 5900000, 'material' => 'Kayu Jati', 'color' => 'Natural'],
            ['name' => 'Rak Buku Minimalis 5 Tingkat', 'category' => 'Rak & Storage', 'price' => 1200000, 'material' => 'Kayu Pinus', 'color' => 'Natural'],
            ['name' => 'Rak TV Modern', 'category' => 'Rak & Storage', 'price' => 1800000, 'material' => 'Kayu MDF', 'color' => 'Hitam Kayu'],
            ['name' => 'Meja Kerja Minimalis', 'category' => 'Meja Kerja', 'price' => 1500000, 'material' => 'Kayu Jati Belanda', 'color' => 'Natural'],
            ['name' => 'Meja Kerja L-Shape', 'category' => 'Meja Kerja', 'price' => 2200000, 'material' => 'Kayu MDF', 'color' => 'Putih'],
            ['name' => 'Kursi Makan Kayu Jati', 'category' => 'Kursi Makan', 'price' => 750000, 'material' => 'Kayu Jati', 'color' => 'Coklat'],
            ['name' => 'Kursi Makan Rotan', 'category' => 'Kursi Makan', 'price' => 650000, 'material' => 'Rotan Sintetis', 'color' => 'Natural'],
            ['name' => 'Cermin Dinding Kayu Bulat', 'category' => 'Dekorasi Rumah', 'price' => 850000, 'material' => 'Kayu Jati', 'color' => 'Natural'],
            ['name' => 'Rak Dinding Dekoratif', 'category' => 'Dekorasi Rumah', 'price' => 450000, 'material' => 'Kayu Pinus', 'color' => 'Putih Natural'],
        ];

        foreach ($products as $index => $item) {
            $category = Category::where('name', $item['category'])->first();

            if (!$category) {
                continue;
            }

            Product::firstOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'category_id' => $category->id,
                    'name' => $item['name'],
                    'description' => "{$item['name']} dengan desain elegan dan material {$item['material']} berkualitas tinggi, cocok untuk melengkapi interior rumah modern Anda.",
                    'specification' => "Material: {$item['material']}\nWarna: {$item['color']}\nFinishing: Coating anti gores",
                    'material' => $item['material'],
                    'dimension' => '120 x 60 x 75 cm',
                    'color' => $item['color'],
                    'price' => $item['price'],
                    'stock' => rand(5, 30),
                    'sku' => 'FRN-' . strtoupper(Str::random(6)),
                    'status' => 'active',
                    'is_featured' => $index % 3 === 0,
                    'is_best_seller' => $index % 4 === 0,
                    'meta_title' => $item['name'],
                    'meta_description' => "Beli {$item['name']} premium berkualitas tinggi dengan harga terbaik.",
                ]
            );
        }
    }
}
