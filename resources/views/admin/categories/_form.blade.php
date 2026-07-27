@php $category = $category ?? null; @endphp
<div>
    <label class="text-sm font-medium text-brown-800">Nama Kategori</label>
    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Slug (opsional)</label>
    <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}" placeholder="Otomatis dari nama jika kosong" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Deskripsi</label>
    <textarea name="description" rows="3" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('description', $category->description ?? '') }}</textarea>
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Thumbnail</label>
    <input type="file" name="thumbnail" accept="image/*" class="mt-1 w-full text-sm">
    @if(($category->thumbnail ?? null))
        <img src="{{ asset('storage/'.$category->thumbnail) }}" class="mt-2 h-20 w-20 rounded-xl object-cover">
    @endif
</div>
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="text-sm font-medium text-brown-800">Urutan</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div class="flex items-end pb-2">
        <label class="flex items-center gap-2 text-sm font-medium text-brown-800">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true)) class="rounded border-wood-400/30">
            Aktifkan Kategori
        </label>
    </div>
</div>
<hr class="border-wood-400/10">
<p class="text-sm font-semibold text-brown-800">SEO Metadata</p>
<div>
    <label class="text-sm font-medium text-brown-800">Meta Title</label>
    <input type="text" name="meta_title" value="{{ old('meta_title', $category->meta_title ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Meta Description</label>
    <textarea name="meta_description" rows="2" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Meta Keywords</label>
    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
