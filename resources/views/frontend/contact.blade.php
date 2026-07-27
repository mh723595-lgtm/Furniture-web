<x-layouts.app :title="'Hubungi Kami'" :description="'Hubungi tim kami untuk konsultasi gratis seputar furniture premium untuk rumah Anda.'">
    <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
        <x-section-heading title="Hubungi Kami" subtitle="Kami siap membantu mewujudkan rumah impian Anda" />

        <div class="mt-10 grid grid-cols-1 gap-8 lg:grid-cols-2">
            <div class="glass-card p-8">
                <h2 class="font-display font-semibold text-brown-800">Kirim Pesan</h2>
                <form method="POST" action="{{ route('contact.submit') }}" class="mt-5 space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-medium text-brown-800">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                        @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-brown-800">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                        @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-brown-800">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                        @error('phone')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-brown-800">Pesan</label>
                        <textarea name="message" rows="4" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="btn-primary w-full">Kirim Pesan</button>
                </form>
            </div>

            <div class="space-y-6">
                <div class="glass-card p-8">
                    <h2 class="font-display font-semibold text-brown-800">Kontak Langsung</h2>
                    <p class="mt-2 text-sm text-brown-800/70">Hubungi kami langsung untuk respon lebih cepat.</p>
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', \App\Models\Setting::get('whatsapp_number', '6285761690400')) }}" target="_blank" rel="noopener" class="btn-whatsapp mt-4 w-full">Chat WhatsApp</a>
                </div>

                @if($showrooms->isNotEmpty())
                <div class="glass-card p-8">
                    <h2 class="font-display font-semibold text-brown-800">Showroom Kami</h2>
                    <ul class="mt-3 space-y-3 text-sm">
                        @foreach($showrooms as $showroom)
                            <li class="border-b border-wood-400/10 pb-3 last:border-0">
                                <p class="font-medium text-brown-800">{{ $showroom->name }}</p>
                                <p class="text-brown-800/60">{{ $showroom->city }}, {{ $showroom->province }}</p>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('showroom.index') }}" class="mt-3 inline-block text-sm font-medium text-wood-600 hover:underline">Lihat semua showroom &rarr;</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
