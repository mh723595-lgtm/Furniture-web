<div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
    <a href="{{ route('home') }}" class="flex items-center gap-2">
        @if($logo)
            <img src="{{ asset('storage/'.$logo) }}" alt="{{ $siteName }}" class="h-14 w-auto">
        @else
            <span class="font-display text-xl font-bold text-wood-600">{{ $siteName }}</span>
        @endif
    </a>

    <nav class="hidden items-center gap-8 lg:flex">
        <a href="{{ route('home') }}" class="text-base font-medium text-brown-800/80 transition hover:text-wood-600 {{ request()->routeIs('home') ? 'text-wood-600' : '' }}">Beranda</a>
        <a href="{{ route('catalog.index') }}" class="text-base font-medium text-brown-800/80 transition hover:text-wood-600 {{ request()->routeIs('catalog.*','category.*','product.*') ? 'text-wood-600' : '' }}">Katalog</a>
        <a href="{{ route('gallery.index') }}" class="text-base font-medium text-brown-800/80 transition hover:text-wood-600 {{ request()->routeIs('gallery.*') ? 'text-wood-600' : '' }}">Galeri</a>
        <a href="{{ route('showroom.index') }}" class="text-base font-medium text-brown-800/80 transition hover:text-wood-600 {{ request()->routeIs('showroom.*') ? 'text-wood-600' : '' }}">Showroom</a>
        <a href="{{ route('about') }}" class="text-base font-medium text-brown-800/80 transition hover:text-wood-600 {{ request()->routeIs('about') ? 'text-wood-600' : '' }}">Tentang Kami</a>
        <a href="{{ route('faq') }}" class="text-base font-medium text-brown-800/80 transition hover:text-wood-600 {{ request()->routeIs('faq') ? 'text-wood-600' : '' }}">FAQ</a>
        <a href="{{ route('contact.index') }}" class="text-base font-medium text-brown-800/80 transition hover:text-wood-600 {{ request()->routeIs('contact.*') ? 'text-wood-600' : '' }}">Kontak</a>
    </nav>

    <div class="flex items-center gap-3">
        <a href="{{ route('search.index') }}" aria-label="Cari produk" class="rounded-full p-2 text-brown-800/70 transition hover:bg-white/70 hover:text-wood-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.35-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </a>
        <a href="https://wa.me/{{ preg_replace('/\D/', '', \App\Models\Setting::get('whatsapp_number', '6285761690400')) }}" target="_blank" rel="noopener"
           class="hidden btn-whatsapp !px-4 !py-2 text-sm sm:inline-flex">
            WhatsApp
        </a>
        <button @click="open = !open" aria-label="Menu" class="rounded-full p-2 text-brown-800/70 hover:bg-white/70 lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>

<div x-show="open" x-cloak x-transition class="glass-nav border-t border-wood-400/10 lg:hidden">
    <nav class="flex flex-col gap-1 px-4 py-3">
        <a href="{{ route('home') }}" class="rounded-xl px-3 py-2 text-brown-800/80 hover:bg-white/60">Beranda</a>
        <a href="{{ route('catalog.index') }}" class="rounded-xl px-3 py-2 text-brown-800/80 hover:bg-white/60">Katalog</a>
        <a href="{{ route('gallery.index') }}" class="rounded-xl px-3 py-2 text-brown-800/80 hover:bg-white/60">Galeri</a>
        <a href="{{ route('showroom.index') }}" class="rounded-xl px-3 py-2 text-brown-800/80 hover:bg-white/60">Showroom</a>
        <a href="{{ route('about') }}" class="rounded-xl px-3 py-2 text-brown-800/80 hover:bg-white/60">Tentang Kami</a>
        <a href="{{ route('faq') }}" class="rounded-xl px-3 py-2 text-brown-800/80 hover:bg-white/60">FAQ</a>
        <a href="{{ route('contact.index') }}" class="rounded-xl px-3 py-2 text-brown-800/80 hover:bg-white/60">Kontak</a>
    </nav>
</div>
