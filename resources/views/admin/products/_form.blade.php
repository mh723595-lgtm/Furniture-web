@php $product = $product ?? null; @endphp
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div>
        <label class="text-sm font-medium text-brown-800">Nama Produk</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Kategori</label>
        <select name="category_id" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
            <option value="">Pilih Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div>
    <label class="text-sm font-medium text-brown-800">Slug (opsional)</label>
    <input type="text" name="slug" value="{{ old('slug', $product->slug ?? '') }}" placeholder="Otomatis dari nama jika kosong" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>

<div>
    <label class="text-sm font-medium text-brown-800">Deskripsi</label>
    <textarea name="description" rows="4" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div>
    <label class="text-sm font-medium text-brown-800">Spesifikasi</label>
    <textarea name="specification" rows="3" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('specification', $product->specification ?? '') }}</textarea>
</div>

<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
    <div>
        <label class="text-sm font-medium text-brown-800">Material</label>
        <input type="text" name="material" value="{{ old('material', $product->material ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Dimensi</label>
        <input type="text" name="dimension" value="{{ old('dimension', $product->dimension ?? '') }}" placeholder="cth: 120x60x75 cm" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Warna</label>
        <input type="text" name="color" value="{{ old('color', $product->color ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
</div>

<div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
    <div>
        <label class="text-sm font-medium text-brown-800">Harga</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Harga Diskon</label>
        <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price', $product->discount_price ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Stok</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">SKU</label>
        <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
</div>

<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
    <div>
        <label class="text-sm font-medium text-brown-800">Status</label>
        <select name="status" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
            <option value="active" @selected(old('status', $product->status ?? 'active') === 'active')>Aktif</option>
            <option value="inactive" @selected(old('status', $product->status ?? '') === 'inactive')>Nonaktif</option>
            <option value="draft" @selected(old('status', $product->status ?? '') === 'draft')>Draft</option>
        </select>
    </div>
    <div class="flex items-end pb-2">
        <label class="flex items-center gap-2 text-sm font-medium text-brown-800">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured ?? false)) class="rounded border-wood-400/30">
            Produk Unggulan
        </label>
    </div>
    <div class="flex items-end pb-2">
        <label class="flex items-center gap-2 text-sm font-medium text-brown-800">
            <input type="checkbox" name="is_best_seller" value="1" @checked(old('is_best_seller', $product->is_best_seller ?? false)) class="rounded border-wood-400/30">
            Best Seller
        </label>
    </div>
</div>

<div>
    <label class="text-sm font-medium text-brown-800">Thumbnail</label>
    <input type="file" name="thumbnail" accept="image/*" class="mt-1 w-full text-sm">
    @if(($product->thumbnail ?? null))
        <img src="{{ asset('storage/'.$product->thumbnail) }}" class="mt-2 h-20 w-20 rounded-xl object-cover">
    @endif
</div>

@if($product)
    {{-- EDIT MODE — gallery is managed via AJAX (add/remove instantly), fully
         independent from the main form below. This avoids nesting a <form>
         inside this page's <form>, which is invalid HTML and previously
         corrupted the product update submission. --}}
    <div x-data="productGallery(
            {{ $product->id }},
            @js($product->images->map(fn ($i) => ['id' => $i->id, 'url' => asset('storage/'.$i->image_path)])->values()),
            '{{ route('admin.products.images.store', $product) }}',
            '{{ url('admin/products/images') }}'
         )">
        <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-brown-800">Galeri Gambar Produk</label>
            <span class="text-xs text-brown-800/50" x-text="images.length + ' gambar'"></span>
        </div>

        <div class="mt-3 flex flex-wrap gap-3">
            <template x-for="image in images" :key="image.id">
                <div class="relative">
                    <img :src="image.url" class="h-16 w-16 rounded-lg object-cover">
                    <button type="button" @click="removeImage(image.id)" :disabled="loading"
                            class="absolute -right-2 -top-2 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white shadow hover:bg-red-600 disabled:opacity-50">
                        &times;
                    </button>
                </div>
            </template>
            <p x-show="images.length === 0" class="text-xs text-brown-800/50">Belum ada gambar tambahan.</p>
        </div>

        <div class="mt-3 flex items-center gap-3">
            <input type="file" accept="image/*" multiple @change="uploadImages" :disabled="loading"
                   class="flex-1 text-sm">
            <span x-show="loading" class="text-xs font-medium text-wood-600">Mengunggah...</span>
        </div>
        <p x-show="error" x-text="error" class="mt-2 text-xs text-red-500"></p>
    </div>
@else
    {{-- CREATE MODE — no existing images yet, a plain multi-file input is safe
         here since there is nothing to delete. Once saved, switch to edit mode
         to manage the gallery (add/remove) via the AJAX widget above. --}}
    <div>
        <label class="text-sm font-medium text-brown-800">Galeri Gambar Tambahan</label>
        <input type="file" name="images[]" accept="image/*" multiple class="mt-1 w-full text-sm">
        <p class="mt-1 text-xs text-brown-800/50">Simpan produk terlebih dahulu, lalu Anda bisa menambah/menghapus gambar galeri kapan saja saat mode edit.</p>
    </div>
@endif

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div>
        <label class="text-sm font-medium text-brown-800">Link WhatsApp (opsional, custom pesan)</label>
        <input type="text" name="whatsapp_link" value="{{ old('whatsapp_link', $product->whatsapp_link ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">URL TikTok Shop</label>
        <input type="text" name="tiktok_url" value="{{ old('tiktok_url', $product->tiktok_url ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
</div>

<hr class="border-wood-400/10">
<p class="text-sm font-semibold text-brown-800">SEO Metadata</p>
<div>
    <label class="text-sm font-medium text-brown-800">Meta Title</label>
    <input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Meta Description</label>
    <textarea name="meta_description" rows="2" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Meta Keywords</label>
    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
