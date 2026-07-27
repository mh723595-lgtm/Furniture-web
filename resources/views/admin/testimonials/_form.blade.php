@php $testimonial = $testimonial ?? null; @endphp
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div>
        <label class="text-sm font-medium text-brown-800">Nama Pelanggan</label>
        <input type="text" name="customer_name" value="{{ old('customer_name', $testimonial->customer_name ?? '') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Kota</label>
        <input type="text" name="city" value="{{ old('city', $testimonial->city ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Foto Pelanggan (opsional)</label>
    <input type="file" name="customer_photo" accept="image/*" class="mt-1 w-full text-sm">
    @if(($testimonial->customer_photo ?? null))
        <img src="{{ asset('storage/'.$testimonial->customer_photo) }}" class="mt-2 h-16 w-16 rounded-full object-cover">
    @endif
</div>
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div>
        <label class="text-sm font-medium text-brown-800">Rating (1-5)</label>
        <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $testimonial->rating ?? 5) }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Kaitkan dengan Produk (opsional)</label>
        <select name="product_id" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
            <option value="">Tidak ada</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}" @selected(old('product_id', $testimonial->product_id ?? '') == $product->id)>{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Isi Testimoni</label>
    <textarea name="content" rows="4" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('content', $testimonial->content ?? '') }}</textarea>
</div>
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="text-sm font-medium text-brown-800">Urutan</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div class="flex items-end pb-2">
        <label class="flex items-center gap-2 text-sm font-medium text-brown-800">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $testimonial->is_active ?? true)) class="rounded border-wood-400/30">
            Tampilkan
        </label>
    </div>
</div>
