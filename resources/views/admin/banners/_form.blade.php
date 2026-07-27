@php $banner = $banner ?? null; @endphp
<div>
    <label class="text-sm font-medium text-brown-800">Judul</label>
    <input type="text" name="title" value="{{ old('title', $banner->title ?? '') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Subjudul</label>
    <input type="text" name="subtitle" value="{{ old('subtitle', $banner->subtitle ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Gambar Banner</label>
    <input type="file" name="image" accept="image/*" class="mt-1 w-full text-sm" {{ $banner ? '' : 'required' }}>
    @if(($banner->image_path ?? null))
        <img src="{{ asset('storage/'.$banner->image_path) }}" class="mt-2 h-20 w-36 rounded-xl object-cover">
    @endif
</div>
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="text-sm font-medium text-brown-800">Teks Tombol</label>
        <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Link Tombol</label>
        <input type="text" name="button_link" value="{{ old('button_link', $banner->button_link ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
</div>
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="text-sm font-medium text-brown-800">Urutan</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order ?? 0) }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div class="flex items-end pb-2">
        <label class="flex items-center gap-2 text-sm font-medium text-brown-800">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $banner->is_active ?? true)) class="rounded border-wood-400/30">
            Tampilkan
        </label>
    </div>
</div>
