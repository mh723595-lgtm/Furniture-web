<x-layouts.admin title="Pengaturan Umum">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.settings.general.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="text-sm font-medium text-brown-800">Nama Website</label>
                <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-brown-800">Tagline</label>
                <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="text-sm font-medium text-brown-800">Logo</label>
                    <input type="file" name="logo" accept="image/*" class="mt-1 w-full text-sm">
                    @if(($settings['logo'] ?? null))<img src="{{ asset('storage/'.$settings['logo']) }}" class="mt-2 h-10">@endif
                </div>
                <div>
                    <label class="text-sm font-medium text-brown-800">Favicon</label>
                    <input type="file" name="favicon" accept="image/*" class="mt-1 w-full text-sm">
                    @if(($settings['favicon'] ?? null))<img src="{{ asset('storage/'.$settings['favicon']) }}" class="mt-2 h-8 w-8">@endif
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div>
                    <label class="text-sm font-medium text-brown-800">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}" placeholder="6281234567890" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="text-sm font-medium text-brown-800">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="text-sm font-medium text-brown-800">Email</label>
                    <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
            </div>
            <div>
                <label class="text-sm font-medium text-brown-800">Alamat</label>
                <textarea name="address" rows="2" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('address', $settings['address'] ?? '') }}</textarea>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="text-sm font-medium text-brown-800">Facebook URL</label>
                    <input type="text" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="text-sm font-medium text-brown-800">Instagram URL</label>
                    <input type="text" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="text-sm font-medium text-brown-800">TikTok URL</label>
                    <input type="text" name="tiktok_url" value="{{ old('tiktok_url', $settings['tiktok_url'] ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="text-sm font-medium text-brown-800">YouTube URL</label>
                    <input type="text" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
            </div>
            <button type="submit" class="btn-primary w-full">Simpan Pengaturan</button>
        </form>
    </div>
</x-layouts.admin>
