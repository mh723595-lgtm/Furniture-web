<x-layouts.app :title="'Katalog Furniture'" :description="'Jelajahi koleksi lengkap furniture premium kami: sofa, meja, lemari, tempat tidur, dan lainnya.'">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <x-section-heading title="Katalog Furniture" subtitle="Temukan furniture premium untuk setiap ruangan di rumah Anda" :center="false" />

        <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-4">
            {{-- FILTER SIDEBAR --}}
            <aside class="lg:col-span-1">
                <form method="GET" action="{{ route('catalog.index') }}" class="glass-card sticky top-24 space-y-5 p-5">
                    <div>
                        <label class="text-sm font-semibold text-brown-800">Kategori</label>
                        <select name="category" class="mt-2 w-full rounded-xl border border-wood-400/20 bg-white/70 px-3 py-2 text-sm">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }} ({{ $category->active_products_count }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-brown-800">Material</label>
                        <input type="text" name="material" value="{{ request('material') }}" placeholder="cth: kayu jati"
                               class="mt-2 w-full rounded-xl border border-wood-400/20 bg-white/70 px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-brown-800">Warna</label>
                        <input type="text" name="color" value="{{ request('color') }}" placeholder="cth: coklat"
                               class="mt-2 w-full rounded-xl border border-wood-400/20 bg-white/70 px-3 py-2 text-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="text-sm font-semibold text-brown-800">Harga Min</label>
                            <input type="number" name="min_price" value="{{ request('min_price') }}" class="mt-2 w-full rounded-xl border border-wood-400/20 bg-white/70 px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-brown-800">Harga Max</label>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" class="mt-2 w-full rounded-xl border border-wood-400/20 bg-white/70 px-3 py-2 text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-brown-800">Urutkan</label>
                        <select name="sort" class="mt-2 w-full rounded-xl border border-wood-400/20 bg-white/70 px-3 py-2 text-sm">
                            <option value="newest" @selected(request('sort') === 'newest')>Terbaru</option>
                            <option value="price_asc" @selected(request('sort') === 'price_asc')>Harga Terendah</option>
                            <option value="price_desc" @selected(request('sort') === 'price_desc')>Harga Tertinggi</option>
                            <option value="popular" @selected(request('sort') === 'popular')>Terpopuler</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-primary w-full">Terapkan Filter</button>
                    <a href="{{ route('catalog.index') }}" class="block text-center text-sm text-brown-800/60 hover:text-wood-600">Reset Filter</a>
                </form>
            </aside>

            {{-- PRODUCT GRID --}}
            <div class="lg:col-span-3">
                <p class="mb-4 text-sm text-brown-800/60">Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk</p>
                @if($products->isNotEmpty())
                    <div class="grid grid-cols-2 gap-5 sm:grid-cols-3">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                    <div class="mt-10">{{ $products->links() }}</div>
                @else
                    <div class="glass-card p-10 text-center text-brown-800/60">Belum ada produk yang sesuai dengan filter Anda.</div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
