<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Furnisha', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Furniture Premium untuk Rumah Impian Anda', 'group' => 'general'],
            ['key' => 'whatsapp_number', 'value' => '6281234567890', 'group' => 'general'],
            ['key' => 'phone', 'value' => '021-1234567', 'group' => 'general'],
            ['key' => 'email', 'value' => 'halo@furnisha.test', 'group' => 'general'],
            ['key' => 'address', 'value' => 'Jl. Furniture Raya No. 1, Jakarta Selatan', 'group' => 'general'],
            ['key' => 'meta_title', 'value' => 'Furnisha - Furniture Premium Indonesia', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Katalog furniture premium berkualitas untuk keluarga Indonesia. Konsultasi gratis via WhatsApp.', 'group' => 'seo'],
            ['key' => 'meta_keywords', 'value' => 'furniture premium, katalog furniture, furniture indonesia, sofa, meja, lemari', 'group' => 'seo'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
