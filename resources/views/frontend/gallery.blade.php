<x-layouts.app :title="'Galeri Inspirasi'" :description="'Lihat berbagai inspirasi penataan furniture premium di rumah pelanggan kami.'">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <x-section-heading title="Galeri Inspirasi" subtitle="Koleksi foto penataan furniture di berbagai hunian" />

        <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
            @foreach($galleries as $gallery)
                <div class="glass-card group aspect-square overflow-hidden">
                    @if($gallery->product)
                        <a href="{{ route('product.show', $gallery->product->slug) }}">
                            <img src="{{ asset('storage/'.$gallery->image_path) }}" alt="{{ $gallery->alt_text ?? $gallery->title }}" loading="lazy" class="h-full w-full object-cover transition group-hover:scale-105">
                        </a>
                    @else
                        <img src="{{ asset('storage/'.$gallery->image_path) }}" alt="{{ $gallery->alt_text ?? $gallery->title }}" loading="lazy" class="h-full w-full object-cover transition group-hover:scale-105">
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-10">{{ $galleries->links() }}</div>
    </div>
</x-layouts.app>
