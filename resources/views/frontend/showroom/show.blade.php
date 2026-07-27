<x-layouts.app :title="$showroom->name" :description="'Showroom ' . $showroom->name . ' di ' . $showroom->city . '. ' . $showroom->address" :image="$showroom->thumbnail">
    <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <nav class="mb-6 text-sm text-brown-800/60">
            <a href="{{ route('home') }}" class="hover:text-wood-600">Beranda</a> /
            <a href="{{ route('showroom.index') }}" class="hover:text-wood-600">Showroom</a> /
            <span class="text-brown-800">{{ $showroom->name }}</span>
        </nav>

        <div class="glass-card overflow-hidden">
            <img src="{{ $showroom->thumbnail ? asset('storage/'.$showroom->thumbnail) : 'https://placehold.co/1200x500/ede4d3/7c5738?text=Showroom' }}"
                 alt="{{ $showroom->name }}" class="h-72 w-full object-cover">
            <div class="p-8">
                <h1 class="font-display text-2xl font-bold text-brown-800 sm:text-3xl">{{ $showroom->name }}</h1>
                <p class="mt-2 text-brown-800/70">{{ $showroom->address }}, {{ $showroom->city }}, {{ $showroom->province }} {{ $showroom->postal_code }}</p>

                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @if($showroom->operational_hours)
                        <div><span class="text-sm text-brown-800/50">Jam Operasional</span><p class="font-medium text-brown-800">{{ $showroom->operational_hours }}</p></div>
                    @endif
                    @if($showroom->phone_number)
                        <div><span class="text-sm text-brown-800/50">Telepon</span><p class="font-medium text-brown-800">{{ $showroom->phone_number }}</p></div>
                    @endif
                    @if($showroom->email)
                        <div><span class="text-sm text-brown-800/50">Email</span><p class="font-medium text-brown-800">{{ $showroom->email }}</p></div>
                    @endif
                </div>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ $showroom->whatsapp_url }}" target="_blank" rel="noopener" class="btn-whatsapp flex-1">Hubungi WhatsApp</a>
                    @if($showroom->gmaps_url)
                        <a href="{{ $showroom->gmaps_url }}" target="_blank" rel="noopener" class="btn-secondary flex-1">Lihat di Google Maps</a>
                    @endif
                </div>

                @if($showroom->gmaps_embed)
                    <div class="mt-8 overflow-hidden rounded-2xl">{!! $showroom->gmaps_embed !!}</div>
                @endif

                @if($showroom->images->isNotEmpty())
                    <div class="mt-8">
                        <h2 class="font-display font-semibold text-brown-800">Galeri Showroom</h2>
                        <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
                            @foreach($showroom->images as $image)
                                <div class="aspect-square overflow-hidden rounded-xl">
                                    <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $showroom->name }}" loading="lazy" class="h-full w-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
