<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['question' => 'Apakah bisa custom ukuran furniture?', 'answer' => 'Ya, kami menerima pemesanan custom ukuran. Silakan hubungi tim kami via WhatsApp untuk konsultasi lebih lanjut.', 'category' => 'Produk'],
            ['question' => 'Berapa lama proses pengiriman?', 'answer' => 'Proses pengiriman biasanya memakan waktu 3-14 hari kerja tergantung lokasi dan ketersediaan stok.', 'category' => 'Pengiriman'],
            ['question' => 'Apakah ada garansi produk?', 'answer' => 'Semua produk kami dilengkapi garansi kualitas material dan pengerjaan selama 1 tahun.', 'category' => 'Produk'],
            ['question' => 'Bagaimana cara melakukan pemesanan?', 'answer' => 'Anda dapat menghubungi kami langsung melalui WhatsApp atau mengunjungi showroom terdekat untuk konsultasi dan pemesanan.', 'category' => 'Pemesanan'],
            ['question' => 'Apakah bisa lihat produk langsung sebelum membeli?', 'answer' => 'Tentu, Anda dapat mengunjungi salah satu showroom kami untuk melihat dan mencoba produk secara langsung.', 'category' => 'Pemesanan'],
            ['question' => 'Apakah harga sudah termasuk ongkos kirim?', 'answer' => 'Harga produk belum termasuk ongkos kirim. Biaya pengiriman akan diinformasikan sesuai lokasi tujuan.', 'category' => 'Pengiriman'],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::firstOrCreate(['question' => $faq['question']], array_merge($faq, ['sort_order' => $index, 'is_active' => true]));
        }
    }
}
