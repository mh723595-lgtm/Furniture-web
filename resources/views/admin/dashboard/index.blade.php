<x-layouts.admin title="Dashboard">
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
        @foreach([
            ['label' => 'Total Produk', 'value' => $stats['total_products']],
            ['label' => 'Produk Aktif', 'value' => $stats['active_products']],
            ['label' => 'Kategori', 'value' => $stats['total_categories']],
            ['label' => 'Showroom', 'value' => $stats['total_showrooms']],
            ['label' => 'Testimoni', 'value' => $stats['total_testimonials']],
            ['label' => 'Stok Habis', 'value' => $stats['out_of_stock']],
        ] as $stat)
            <div class="glass-card p-5">
                <p class="text-xs font-medium uppercase text-brown-800/50">{{ $stat['label'] }}</p>
                <p class="mt-2 font-display text-2xl font-bold text-brown-800">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="glass-card p-5">
            <h2 class="font-display font-semibold text-brown-800">Produk Terbaru</h2>
            <div class="mt-4 divide-y divide-wood-400/10">
                @forelse($latestProducts as $product)
                    <div class="flex items-center justify-between py-3 text-sm">
                        <div>
                            <p class="font-medium text-brown-800">{{ $product->name }}</p>
                            <p class="text-xs text-brown-800/50">{{ $product->category->name ?? '-' }}</p>
                        </div>
                        <span class="text-brown-800/60">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                @empty
                    <p class="py-3 text-sm text-brown-800/50">Belum ada produk.</p>
                @endforelse
            </div>
        </div>
        <div class="glass-card p-5">
            <h2 class="font-display font-semibold text-brown-800">Produk Terpopuler</h2>
            <div class="mt-4 divide-y divide-wood-400/10">
                @forelse($mostViewed as $product)
                    <div class="flex items-center justify-between py-3 text-sm">
                        <p class="font-medium text-brown-800">{{ $product->name }}</p>
                        <span class="text-brown-800/60">{{ $product->views }} views</span>
                    </div>
                @empty
                    <p class="py-3 text-sm text-brown-800/50">Belum ada data.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.admin>
