<x-layouts.app :title="'Showroom Kami'" :description="'Kunjungi showroom furniture premium kami di berbagai kota di Indonesia.'">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <x-section-heading title="Showroom Kami" subtitle="Kunjungi dan rasakan langsung kualitas furniture premium kami" />

        <form method="GET" class="mx-auto mt-8 flex max-w-md gap-2">
            <input type="text" name="city" value="{{ request('city') }}" placeholder="Cari berdasarkan kota..."
                   class="flex-1 rounded-full border-0 bg-white/70 px-5 py-3 text-sm shadow-sm focus:ring-2 focus:ring-wood-400">
            <button type="submit" class="btn-primary">Cari</button>
        </form>

        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($showrooms as $showroom)
                <div class="glass-card overflow-hidden">
                    <img src="{{ $showroom->thumbnail ? asset('storage/'.$showroom->thumbnail) : 'https://placehold.co/600x400/ede4d3/7c5738?text=Showroom' }}"
                         alt="{{ $showroom->name }}" loading="lazy" class="h-48 w-full object-cover">
                    <div class="p-5">
                        <h3 class="font-display font-semibold text-brown-800">{{ $showroom->name }}</h3>
                        <p class="mt-1 text-sm text-brown-800/70">{{ $showroom->address }}</p>
                        <p class="text-sm text-brown-800/50">{{ $showroom->city }}, {{ $showroom->province }}</p>
                        @if($showroom->operational_hours)
                            <p class="mt-2 text-xs text-brown-800/50">Jam Operasional: {{ $showroom->operational_hours }}</p>
                        @endif
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('showroom.show', $showroom->slug) }}" class="btn-secondary !px-4 !py-2 text-sm">Detail</a>
                            <a href="{{ $showroom->whatsapp_url }}" target="_blank" rel="noopener" class="btn-whatsapp !px-4 !py-2 text-sm">WhatsApp</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="glass-card col-span-full p-10 text-center text-brown-800/60">Belum ada showroom yang tersedia.</div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
