@php $gallery = $gallery ?? null; @endphp
<div>
    <label class="text-sm font-medium text-brown-800">Judul (opsional)</label>
    <input type="text" name="title" value="{{ old('title', $gallery->title ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Gambar</label>
    <input type="file" name="image" accept="image/*" class="mt-1 w-full text-sm" {{ $gallery ? '' : 'required' }}>
    @if(($gallery->image_path ?? null))
        <img src="{{ asset('storage/'.$gallery->image_path) }}" class="mt-2 h-20 w-20 rounded-xl object-cover">
    @endif
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Alt Text</label>
    <input type="text" name="alt_text" value="{{ old('alt_text', $gallery->alt_text ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Kaitkan dengan Produk (opsional)</label>
    <select name="product_id" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
        <option value="">Tidak ada</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}" @selected(old('product_id', $gallery->product_id ?? '') == $product->id)>{{ $product->name }}</option>
        @endforeach
    </select>
</div>
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="text-sm font-medium text-brown-800">Urutan</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order ?? 0) }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div class="flex items-end pb-2">
        <label class="flex items-center gap-2 text-sm font-medium text-brown-800">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $gallery->is_active ?? true)) class="rounded border-wood-400/30">
            Tampilkan
        </label>
    </div>
</div>
