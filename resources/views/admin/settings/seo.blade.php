<x-layouts.admin title="Pengaturan SEO">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.settings.seo.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="text-sm font-medium text-brown-800">Meta Title Default</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $settings['meta_title'] ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-brown-800">Meta Description Default</label>
                <textarea name="meta_description" rows="3" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="text-sm font-medium text-brown-800">Meta Keywords Default</label>
                <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $settings['meta_keywords'] ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-brown-800">Gambar Open Graph Default</label>
                <input type="file" name="og_image" accept="image/*" class="mt-1 w-full text-sm">
                @if(($settings['og_image'] ?? null))<img src="{{ asset('storage/'.$settings['og_image']) }}" class="mt-2 h-20 w-36 rounded-xl object-cover">@endif
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="text-sm font-medium text-brown-800">Google Analytics ID</label>
                    <input type="text" name="google_analytics_id" value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="text-sm font-medium text-brown-800">Google Search Console Verification</label>
                    <input type="text" name="google_search_console" value="{{ old('google_search_console', $settings['google_search_console'] ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
            </div>
            <button type="submit" class="btn-primary w-full">Simpan Pengaturan SEO</button>
        </form>
    </div>
</x-layouts.admin>
