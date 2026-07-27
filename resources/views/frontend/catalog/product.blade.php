@php
    $waLink = $product->whatsapp_link ?: ('https://wa.me/' . preg_replace('/\D/', '', \App\Models\Setting::get('whatsapp_number', '628000000000')) . '?text=' . urlencode('Halo, saya tertarik dengan produk ' . $product->name));
@endphp
<x-layouts.app :title="$product->meta_title ?? $product->name" :description="$product->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($product->description), 160)" :keywords="$product->meta_keywords" :image="$product->thumbnail">

    <x-slot:jsonLd>
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $product->name,
        'description' => strip_tags($product->description),
        'image' => $product->thumbnail ? asset('storage/'.$product->thumbnail) : null,
        'sku' => $product->sku,
        'offers' => [
            '@type' => 'Offer',
            'priceCurrency' => 'IDR',
            'price' => (string) $product->final_price,
            'availability' => $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
        ],
    ]) !!}
    </x-slot:jsonLd>

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <nav class="mb-6 text-sm text-brown-800/60">
            <a href="{{ route('home') }}" class="hover:text-wood-600">Beranda</a> /
            <a href="{{ route('catalog.index') }}" class="hover:text-wood-600">Katalog</a> /
            <a href="{{ route('category.show', $product->category->slug) }}" class="hover:text-wood-600">{{ $product->category->name }}</a> /
            <span class="text-brown-800">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-2">
            {{-- GALLERY --}}
            <div x-data="{ active: '{{ $product->thumbnail ? asset('storage/'.$product->thumbnail) : 'https://placehold.co/800x800/ede4d3/7c5738?text=Furnisha' }}' }">
                <div class="glass-card aspect-square overflow-hidden">
                    <img :src="active" alt="{{ $product->name }}" class="h-full w-full object-cover">
                </div>
                @if($product->images->isNotEmpty())
                    <div class="mt-4 grid grid-cols-5 gap-3">
                        @if($product->thumbnail)
                        <button @click="active = '{{ asset('storage/'.$product->thumbnail) }}'" class="aspect-square overflow-hidden rounded-xl border-2 border-transparent hover:border-wood-400">
                            <img src="{{ asset('storage/'.$product->thumbnail) }}" class="h-full w-full object-cover" alt="thumbnail">
                        </button>
                        @endif
                        @foreach($product->images as $image)
                            <button @click="active = '{{ asset('storage/'.$image->image_path) }}'" class="aspect-square overflow-hidden rounded-xl border-2 border-transparent hover:border-wood-400">
                                <img src="{{ asset('storage/'.$image->image_path) }}" class="h-full w-full object-cover" alt="{{ $image->alt_text }}">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- INFO --}}
            <div>
                <p class="text-sm font-medium uppercase tracking-wide text-olive-600">{{ $product->category->name }}</p>
                <h1 class="mt-1 font-display text-2xl font-bold text-brown-800 sm:text-3xl">{{ $product->name }}</h1>

                <div class="mt-4 flex items-baseline gap-3">
                    @if($product->has_discount)
                        <span class="text-lg text-brown-800/40 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="font-display text-2xl font-bold text-wood-600">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                    @else
                        <span class="font-display text-2xl font-bold text-wood-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    @endif
                </div>

                <p class="mt-2 text-sm {{ $product->stock > 0 ? 'text-olive-600' : 'text-red-500' }}">
                    {{ $product->stock > 0 ? 'Stok Tersedia' : 'Stok Habis' }}
                </p>

                <div class="glass-card mt-6 grid grid-cols-2 gap-4 p-5 text-sm">
                    @if($product->material)<div><span class="text-brown-800/50">Material</span><p class="font-medium text-brown-800">{{ $product->material }}</p></div>@endif
                    @if($product->dimension)<div><span class="text-brown-800/50">Dimensi</span><p class="font-medium text-brown-800">{{ $product->dimension }}</p></div>@endif
                    @if($product->color)<div><span class="text-brown-800/50">Warna</span><p class="font-medium text-brown-800">{{ $product->color }}</p></div>@endif
                    @if($product->sku)<div><span class="text-brown-800/50">SKU</span><p class="font-medium text-brown-800">{{ $product->sku }}</p></div>@endif
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn-whatsapp flex-1">Tanya via WhatsApp</a>
                    @if($product->tiktok_url)
                        <a href="{{ $product->tiktok_url }}" target="_blank" rel="noopener" class="btn-secondary flex-1">Lihat di TikTok</a>
                    @endif
                </div>

                @if($product->description)
                    <div class="mt-8">
                        <h2 class="font-display font-semibold text-brown-800">Deskripsi Produk</h2>
                        <div class="mt-2 text-sm leading-relaxed text-brown-800/70">{!! nl2br(e($product->description)) !!}</div>
                    </div>
                @endif

                @if($product->specification)
                    <div class="mt-6">
                        <h2 class="font-display font-semibold text-brown-800">Spesifikasi</h2>
                        <div class="mt-2 text-sm leading-relaxed text-brown-800/70">{!! nl2br(e($product->specification)) !!}</div>
                    </div>
                @endif
            </div>
        </div>

        @if($product->testimonials->isNotEmpty())
        <div class="mt-16">
            <x-section-heading title="Testimoni Pelanggan" :center="false" />
            <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-3">
                @foreach($product->testimonials as $testimonial)
                    <div class="glass-card p-5">
                        <p class="text-sm italic text-brown-800/80">"{{ $testimonial->content }}"</p>
                        <p class="mt-3 text-sm font-semibold text-brown-800">{{ $testimonial->customer_name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($relatedProducts->isNotEmpty())
        <div class="mt-16">
            <x-section-heading title="Produk Serupa" :center="false" />
            <div class="mt-6 grid grid-cols-2 gap-5 sm:grid-cols-4">
                @foreach($relatedProducts as $related)
                    <x-product-card :product="$related" />
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-layouts.app>
