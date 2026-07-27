<x-layouts.app>
    <x-slot:jsonLd>
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => \App\Models\Setting::get('site_name', 'Furnisha'),
        'url' => url('/'),
        'logo' => \App\Models\Setting::get('logo') ? asset('storage/'.\App\Models\Setting::get('logo')) : null,
    ]) !!}
    </x-slot:jsonLd>

    {{-- ============================================================ --}}
    {{-- HERO — full screen, zoom background, parallax on scroll,      --}}
    {{-- transparent glass card (right) + animated letters (left).     --}}
    {{-- Background pakai gambar dummy dulu — tinggal ganti src/asset  --}}
    {{-- atau hubungkan lagi ke $banners kapan pun siap.                --}}
    {{-- ============================================================ --}}
    <section class="relative h-screen w-full overflow-hidden"
             x-data="{ active: 0, total: {{ max($banners->count(), 1) }}, scrollY: 0 }"
             x-init="setInterval(() => active = (active + 1) % total, 6000)"
             @scroll.window.passive="scrollY = window.scrollY">

        {{-- Parallax layer: moves slower than the page while scrolling --}}
        <div class="absolute -inset-y-16 inset-x-0 will-change-transform"
             :style="`transform: translateY(${scrollY * 0.25}px)`">

            @forelse($banners as $index => $banner)
                <div x-show="active === {{ $index }}"
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-700"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0 overflow-hidden">
                    <img src="{{ asset('storage/'.$banner->image_path) }}" alt="{{ $banner->title }}"
                         class="animate-hero-zoom-loop h-full w-full scale-110 object-cover">
                </div>
            @empty
                {{-- Dummy placeholder — ganti url ini nanti setelah upload banner asli lewat Admin > Banner --}}
                <div class="absolute inset-0 overflow-hidden">
                    <img src="https://placehold.co/1920x1080/e0d3ba/4a3728?text=Furnisha+Premium+Furniture"
                         alt="Furnisha Premium Furniture"
                         class="animate-hero-zoom-loop h-full w-full scale-110 object-cover">
                </div>
            @endforelse
        </div>

        {{-- Readability overlays (glassmorphism-friendly gradient, tetap terang/warm) --}}
        <div class="absolute inset-0 bg-gradient-to-t from-cream-50 via-cream-50/20 to-brown-800/25"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-cream-50/80 via-cream-50/10 to-transparent"></div>

        {{-- Foreground content --}}
        <div class="relative z-10 flex h-full items-center">
            <div class="mx-auto grid w-full max-w-7xl grid-cols-1 items-center gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8">

                {{-- LEFT: headline dengan animasi in-out di beberapa huruf --}}
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-olive-600">
                        {{ \App\Models\Setting::get('site_tagline', 'Furniture Premium Indonesia') }}
                    </p>
                    <h1 class="mt-4 font-display text-4xl font-bold leading-[1.1] text-brown-800 sm:text-5xl lg:text-6xl">
                        Furniture
                        <span class="inline-flex text-wood-600">
                            @foreach(str_split('Premium') as $i => $char)
                                <span class="letter-breathe" style="animation-delay: {{ $i * 0.12 }}s">{{ $char }}</span>
                            @endforeach
                        </span>
                        <br>
                        untuk Rumah Impian Anda
                    </h1>
                    <p class="mt-6 max-w-md text-base text-brown-800/70 sm:text-lg">
                        Desain hangat, material terbaik, dan kualitas terjamin — dirancang untuk menemani setiap momen keluarga Indonesia.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('catalog.index') }}" class="btn-primary">Lihat Katalog</a>
                        <a href="{{ route('about') }}" class="btn-secondary">Pelajari Lebih Lanjut</a>
                    </div>
                </div>

                {{-- RIGHT: glass card transparan --}}
                <div class="hidden lg:block">
                    <div class="glass-card-light ml-auto w-full max-w-sm p-8">
                        <h3 class="font-display text-lg font-semibold text-brown-800">Kenapa Memilih Kami</h3>
                        <ul class="mt-5 space-y-4 text-sm text-brown-800/80">
                            @foreach([
                                'Material kayu solid pilihan',
                                'Konsultasi gratis via WhatsApp',
                                'Showroom tersebar di berbagai kota',
                                'Garansi kualitas produk',
                            ] as $item)
                                <li class="flex items-center gap-3">
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-wood-500/20 text-wood-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </span>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if($banners->count() > 1)
        <div class="absolute bottom-8 left-1/2 z-10 flex -translate-x-1/2 gap-2">
            @foreach($banners as $index => $banner)
                <button @click="active = {{ $index }}" class="h-2 w-2 rounded-full bg-brown-800/30 transition-all duration-500" :class="active === {{ $index }} ? '!w-7 !bg-wood-500' : ''"></button>
            @endforeach
        </div>
        @endif

        {{-- scroll cue --}}
        <div class="absolute bottom-8 right-6 hidden text-brown-800/40 sm:block" style="animation: float-hint 2.4s ease-in-out infinite;">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </div>
    </section>

    {{-- CATEGORIES --}}
    @if($categories->isNotEmpty())
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <x-section-heading title="Kategori Furniture" subtitle="Temukan furniture sesuai kebutuhan ruangan Anda" />
        <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8">
            @foreach($categories as $category)
                <x-category-card :category="$category" />
            @endforeach
        </div>
    </section>
    @endif

    {{-- FEATURED PRODUCTS --}}
    @if($featuredProducts->isNotEmpty())
    <section class="bg-beige-100/50 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-section-heading title="Produk Unggulan" subtitle="Pilihan terbaik untuk rumah Anda" />
            <div class="mt-10 grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-4">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
            <div class="mt-10 text-center">
                <a href="{{ route('catalog.index') }}" class="btn-secondary">Lihat Semua Produk</a>
            </div>
        </div>
    </section>
    @endif

    {{-- BEST SELLERS --}}
    @if($bestSellers->isNotEmpty())
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <x-section-heading title="Best Seller" subtitle="Produk paling diminati pelanggan kami" />
        <div class="mt-10 grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-4">
            @foreach($bestSellers as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>
    @endif

    {{-- WHY CHOOSE US --}}
    <section class="bg-olive-500/5 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-section-heading title="Mengapa Memilih Kami" />
            <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach([
                    ['title' => 'Material Premium', 'desc' => 'Kayu solid dan bahan pilihan berkualitas tinggi.'],
                    ['title' => 'Garansi Produk', 'desc' => 'Jaminan kualitas untuk setiap pembelian furniture.'],
                    ['title' => 'Konsultasi Gratis', 'desc' => 'Tim kami siap membantu memilih furniture terbaik.'],
                    ['title' => 'Multi Showroom', 'desc' => 'Kunjungi showroom kami di berbagai kota.'],
                ] as $item)
                    <div class="glass-card p-6 text-center">
                        <h3 class="font-display font-semibold text-brown-800">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm text-brown-800/70">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- GALLERY --}}
    @if($galleries->isNotEmpty())
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <x-section-heading title="Galeri Inspirasi" subtitle="Lihat bagaimana furniture kami mempercantik rumah pelanggan" />
        <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-4">
            @foreach($galleries as $gallery)
                <div class="glass-card aspect-square overflow-hidden">
                    <img src="{{ asset('storage/'.$gallery->image_path) }}" alt="{{ $gallery->alt_text ?? $gallery->title }}" loading="lazy" class="h-full w-full object-cover transition hover:scale-105">
                </div>
            @endforeach
        </div>
        <div class="mt-10 text-center">
            <a href="{{ route('gallery.index') }}" class="btn-secondary">Lihat Galeri Lengkap</a>
        </div>
    </section>
    @endif

    {{-- SHOWROOM --}}
    @if($showrooms->isNotEmpty())
    <section class="bg-beige-100/50 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-section-heading title="Showroom Terdekat" subtitle="Kunjungi dan lihat langsung koleksi furniture kami" />
            <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-3">
                @foreach($showrooms as $showroom)
                    <div class="glass-card overflow-hidden">
                        <img src="{{ $showroom->thumbnail ? asset('storage/'.$showroom->thumbnail) : 'https://placehold.co/600x400/ede4d3/7c5738?text=Showroom' }}"
                             alt="{{ $showroom->name }}" loading="lazy" class="h-44 w-full object-cover">
                        <div class="p-5">
                            <h3 class="font-display font-semibold text-brown-800">{{ $showroom->name }}</h3>
                            <p class="mt-1 text-sm text-brown-800/70">{{ $showroom->city }}, {{ $showroom->province }}</p>
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('showroom.show', $showroom->slug) }}" class="btn-secondary !px-4 !py-2 text-sm">Detail</a>
                                <a href="{{ $showroom->whatsapp_url }}" target="_blank" rel="noopener" class="btn-whatsapp !px-4 !py-2 text-sm">WhatsApp</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- TESTIMONIALS --}}
    @if($testimonials->isNotEmpty())
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <x-section-heading title="Apa Kata Pelanggan" subtitle="Cerita keluarga yang sudah mempercayai kami" />
        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($testimonials as $testimonial)
                <div class="glass-card p-6">
                    <div class="flex items-center gap-1 text-wood-500">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        @endfor
                    </div>
                    <p class="mt-3 text-sm italic text-brown-800/80">"{{ $testimonial->content }}"</p>
                    <p class="mt-4 text-sm font-semibold text-brown-800">{{ $testimonial->customer_name }}</p>
                    @if($testimonial->city)<p class="text-xs text-brown-800/50">{{ $testimonial->city }}</p>@endif
                </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- FAQ --}}
    @if($faqs->isNotEmpty())
    <section class="bg-beige-100/50 py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <x-section-heading title="Pertanyaan Umum" />
            <div class="mt-10 space-y-3" x-data="{ openIndex: null }">
                @foreach($faqs as $index => $faq)
                    <div class="glass-card overflow-hidden">
                        <button @click="openIndex = openIndex === {{ $index }} ? null : {{ $index }}" class="flex w-full items-center justify-between p-5 text-left font-medium text-brown-800">
                            {{ $faq->question }}
                            <svg class="h-5 w-5 shrink-0 transition" :class="openIndex === {{ $index }} ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="openIndex === {{ $index }}" x-collapse class="px-5 pb-5 text-sm text-brown-800/70">{{ $faq->answer }}</div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('faq') }}" class="btn-secondary">Lihat Semua FAQ</a>
            </div>
        </div>
    </section>
    @endif

    {{-- WHATSAPP CTA --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="glass-card flex flex-col items-center gap-4 p-10 text-center">
            <h2 class="section-title">Butuh Rekomendasi Furniture?</h2>
            <p class="max-w-xl text-brown-800/70">Konsultasikan kebutuhan furniture rumah Anda secara gratis dengan tim kami melalui WhatsApp.</p>
            <a href="https://wa.me/{{ preg_replace('/\D/', '', \App\Models\Setting::get('whatsapp_number', '6285761690400')) }}" target="_blank" rel="noopener" class="btn-whatsapp">
                Chat via WhatsApp
            </a>
        </div>
    </section>
</x-layouts.app>
