<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\View\View;

class SeoMeta extends Component
{
    public string $pageTitle;
    public string $pageDescription;
    public string $pageKeywords;
    public ?string $ogImage;
    public string $canonicalUrl;

    public function __construct(
        ?string $title = null,
        ?string $description = null,
        ?string $keywords = null,
        ?string $image = null,
    ) {
        $siteName = Setting::get('site_name', 'Premium Furniture Catalog');

        $this->pageTitle = $title ? "{$title} | {$siteName}" : $siteName . ' - ' . Setting::get('site_tagline', 'Furniture Premium untuk Rumah Impian Anda');
        $this->pageDescription = $description ?? Setting::get('meta_description', 'Katalog furniture premium berkualitas untuk keluarga Indonesia. Konsultasi gratis via WhatsApp.');
        $this->pageKeywords = $keywords ?? Setting::get('meta_keywords', 'furniture premium, katalog furniture, furniture indonesia');
        $this->ogImage = $image ? asset('storage/' . $image) : (Setting::get('og_image') ? asset('storage/' . Setting::get('og_image')) : null);
        $this->canonicalUrl = url()->current();
    }

    public function render(): View
    {
        return view('components.seo-meta');
    }
}
