<x-layouts.app :title="$category->meta_title ?? $category->name" :description="$category->meta_description ?? $category->description" :keywords="$category->meta_keywords" :image="$category->thumbnail">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <nav class="mb-6 text-sm text-brown-800/60">
            <a href="{{ route('home') }}" class="hover:text-wood-600">Beranda</a> /
            <a href="{{ route('catalog.index') }}" class="hover:text-wood-600">Katalog</a> /
            <span class="text-brown-800">{{ $category->name }}</span>
        </nav>

        <x-section-heading :title="$category->name" :subtitle="$category->description" :center="false" />

        <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-4">
            <aside class="hidden lg:col-span-1 lg:block">
                <div class="glass-card sticky top-24 p-5">
                    <h3 class="mb-3 font-display font-semibold text-brown-800">Kategori Lain</h3>
                    <ul class="space-y-2 text-sm">
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('category.show', $cat->slug) }}" class="flex justify-between rounded-lg px-3 py-2 {{ $cat->id === $category->id ? 'bg-wood-500/10 text-wood-600 font-medium' : 'text-brown-800/70 hover:bg-white/60' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span class="text-xs text-brown-800/50">{{ $cat->active_products_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
            <div class="lg:col-span-3">
                @if($products->isNotEmpty())
                    <div class="grid grid-cols-2 gap-5 sm:grid-cols-3">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                    <div class="mt-10">{{ $products->links() }}</div>
                @else
                    <div class="glass-card p-10 text-center text-brown-800/60">Belum ada produk pada kategori ini.</div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
