@props(['category'])
<a href="{{ route('category.show', $category->slug) }}" class="glass-card group relative flex flex-col items-center gap-3 overflow-hidden p-6 text-center transition hover:-translate-y-1 hover:shadow-xl">
    <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-2xl bg-beige-100">
        <img src="{{ $category->thumbnail ? asset('storage/'.$category->thumbnail) : 'https://placehold.co/200x200/ede4d3/7c5738?text=%20' }}"
             alt="{{ $category->name }}" loading="lazy" class="h-full w-full object-cover">
    </div>
    <div>
        <h3 class="font-display font-semibold text-brown-800">{{ $category->name }}</h3>
        <p class="text-xs text-brown-800/60">{{ $category->active_products_count ?? 0 }} produk</p>
    </div>
</a>
