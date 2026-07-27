<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    use HandlesImageUploads;

    public function general(): View
    {
        $settings = Setting::where('group', 'general')->pluck('value', 'key');

        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:1024'],
            'favicon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,ico', 'max:512'],
            'whatsapp_number' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'tiktok_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
        ]);

        foreach ($validated as $key => $value) {
            if (in_array($key, ['logo', 'favicon'])) {
                continue;
            }
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => 'general']);
        }

        if ($request->hasFile('logo')) {
            Setting::updateOrCreate(['key' => 'logo'], [
                'value' => $this->storeImage($request->file('logo'), 'settings'),
                'group' => 'general',
                'type' => 'image',
            ]);
        }

        if ($request->hasFile('favicon')) {
            Setting::updateOrCreate(['key' => 'favicon'], [
                'value' => $this->storeImage($request->file('favicon'), 'settings'),
                'group' => 'general',
                'type' => 'image',
            ]);
        }

        return back()->with('success', 'Pengaturan umum berhasil diperbarui.');
    }

    public function seo(): View
    {
        $settings = Setting::where('group', 'seo')->pluck('value', 'key');

        return view('admin.settings.seo', compact('settings'));
    }

    public function updateSeo(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'og_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'google_analytics_id' => ['nullable', 'string', 'max:100'],
            'google_search_console' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($validated as $key => $value) {
            if ($key === 'og_image') {
                continue;
            }
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => 'seo']);
        }

        if ($request->hasFile('og_image')) {
            Setting::updateOrCreate(['key' => 'og_image'], [
                'value' => $this->storeImage($request->file('og_image'), 'settings'),
                'group' => 'seo',
                'type' => 'image',
            ]);
        }

        return back()->with('success', 'Pengaturan SEO berhasil diperbarui.');
    }
}
