@props(['product'])
<a href="{{ route('product.show', $product->slug) }}" class="product-card group">
    <div class="relative aspect-square overflow-hidden rounded-t-3xl bg-beige-100">
        <img src="{{ $product->thumbnail ? asset('storage/'.$product->thumbnail) : 'https://placehold.co/600x600/ede4d3/7c5738?text=Furnisha' }}"
             alt="{{ $product->name }}" loading="lazy"
             class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        <div class="absolute left-3 top-3 flex flex-col gap-2">
            @if($product->is_best_seller)
                <span class="rounded-full bg-wood-500/90 px-3 py-1 text-xs font-semibold text-white backdrop-blur">Best Seller</span>
            @endif
            @if($product->has_discount)
                <span class="rounded-full bg-red-500/90 px-3 py-1 text-xs font-semibold text-white backdrop-blur">Diskon</span>
            @endif
        </div>
    </div>
    <div class="p-4">
        <p class="text-xs font-medium uppercase tracking-wide text-olive-600">{{ $product->category->name ?? '' }}</p>
        <h3 class="mt-1 line-clamp-2 font-display font-semibold text-brown-800">{{ $product->name }}</h3>
        <div class="mt-2 flex items-baseline gap-2">
            @if($product->has_discount)
                <span class="text-sm text-brown-800/50 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                <span class="font-semibold text-wood-600">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
            @else
                <span class="font-semibold text-wood-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            @endif
        </div>
    </div>
</a>
