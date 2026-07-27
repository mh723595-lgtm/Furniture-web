<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['customer_name' => 'Ibu Ratna', 'city' => 'Jakarta', 'rating' => 5, 'content' => 'Kualitas furniturenya sangat bagus, sesuai dengan yang ditampilkan di katalog. Pelayanan juga ramah dan responsif.'],
            ['customer_name' => 'Bapak Andi', 'city' => 'Bandung', 'rating' => 5, 'content' => 'Sofa yang saya beli awet dan nyaman. Proses pengiriman juga cepat, sangat puas dengan pelayanannya.'],
            ['customer_name' => 'Ibu Siti', 'city' => 'Surabaya', 'rating' => 4, 'content' => 'Desainnya elegan dan cocok untuk rumah minimalis kami. Recommended untuk keluarga muda.'],
            ['customer_name' => 'Bapak Budi', 'city' => 'Jakarta', 'rating' => 5, 'content' => 'Konsultasi via WhatsApp sangat membantu memilih furniture yang tepat untuk ruang tamu kami.'],
        ];

        foreach ($testimonials as $index => $item) {
            Testimonial::firstOrCreate(
                ['customer_name' => $item['customer_name'], 'content' => $item['content']],
                array_merge($item, ['sort_order' => $index, 'is_active' => true])
            );
        }
    }
}
