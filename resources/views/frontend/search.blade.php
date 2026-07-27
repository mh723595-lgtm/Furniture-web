<x-layouts.app :title="'Pencarian: ' . ($keyword ?? '')" :description="'Cari produk furniture premium sesuai kebutuhan Anda.'">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('search.index') }}" class="glass-card mx-auto flex max-w-2xl gap-3 p-3">
            <input type="text" name="q" value="{{ $keyword }}" placeholder="Cari sofa, meja, lemari, dan lainnya..."
                   class="flex-1 rounded-full border-0 bg-white/70 px-5 py-3 text-sm focus:ring-2 focus:ring-wood-400">
            <button type="submit" class="btn-primary">Cari</button>
        </form>

        <div class="mt-10">
            @if($keyword)
                <p class="mb-6 text-brown-800/60">Menampilkan {{ $products->total() }} hasil untuk "<span class="font-semibold text-brown-800">{{ $keyword }}</span>"</p>
            @endif

            @if($products->isNotEmpty())
                <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
                <div class="mt-10">{{ $products->links() }}</div>
            @else
                <div class="glass-card p-10 text-center text-brown-800/60">
                    @if($keyword)
                        Produk tidak ditemukan. Coba kata kunci lain atau hubungi kami via WhatsApp untuk bantuan.
                    @else
                        Masukkan kata kunci untuk mulai mencari produk.
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
