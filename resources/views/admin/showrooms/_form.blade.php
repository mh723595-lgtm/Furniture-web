@php $showroom = $showroom ?? null; @endphp
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div>
        <label class="text-sm font-medium text-brown-800">Nama Cabang</label>
        <input type="text" name="name" value="{{ old('name', $showroom->name ?? '') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Slug (opsional)</label>
        <input type="text" name="slug" value="{{ old('slug', $showroom->slug ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Alamat</label>
    <textarea name="address" rows="2" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('address', $showroom->address ?? '') }}</textarea>
</div>
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
    <div>
        <label class="text-sm font-medium text-brown-800">Kota</label>
        <input type="text" name="city" value="{{ old('city', $showroom->city ?? '') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Provinsi</label>
        <input type="text" name="province" value="{{ old('province', $showroom->province ?? '') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Kode Pos</label>
        <input type="text" name="postal_code" value="{{ old('postal_code', $showroom->postal_code ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
</div>
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
    <div>
        <label class="text-sm font-medium text-brown-800">Nomor WhatsApp</label>
        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $showroom->whatsapp_number ?? '') }}" placeholder="6285761690400" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Nomor Telepon</label>
        <input type="text" name="phone_number" value="{{ old('phone_number', $showroom->phone_number ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Email</label>
        <input type="email" name="email" value="{{ old('email', $showroom->email ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Jam Operasional</label>
    <input type="text" name="operational_hours" value="{{ old('operational_hours', $showroom->operational_hours ?? '') }}" placeholder="Senin - Minggu, 09.00 - 20.00" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Thumbnail</label>
    <input type="file" name="thumbnail" accept="image/*" class="mt-1 w-full text-sm">
    @if(($showroom->thumbnail ?? null))
        <img src="{{ asset('storage/'.$showroom->thumbnail) }}" class="mt-2 h-20 w-20 rounded-xl object-cover">
    @endif
</div>
@if($showroom)
    {{-- EDIT MODE — gallery managed via AJAX, independent from this page's
         main <form> to avoid invalid nested-form HTML that previously broke
         the update submission. --}}
    <div x-data="showroomGallery(
            {{ $showroom->id }},
            @js($showroom->images->map(fn ($i) => ['id' => $i->id, 'url' => asset('storage/'.$i->image_path)])->values()),
            '{{ route('admin.showrooms.images.store', $showroom) }}',
            '{{ url('admin/showrooms/images') }}'
         )">
        <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-brown-800">Galeri Foto Showroom</label>
            <span class="text-xs text-brown-800/50" x-text="images.length + ' foto'"></span>
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
            <p x-show="images.length === 0" class="text-xs text-brown-800/50">Belum ada foto galeri.</p>
        </div>

        <div class="mt-3 flex items-center gap-3">
            <input type="file" accept="image/*" multiple @change="uploadImages" :disabled="loading" class="flex-1 text-sm">
            <span x-show="loading" class="text-xs font-medium text-wood-600">Mengunggah...</span>
        </div>
        <p x-show="error" x-text="error" class="mt-2 text-xs text-red-500"></p>
    </div>
@else
    <div>
        <label class="text-sm font-medium text-brown-800">Galeri Foto Showroom</label>
        <input type="file" name="gallery[]" accept="image/*" multiple class="mt-1 w-full text-sm">
        <p class="mt-1 text-xs text-brown-800/50">Simpan showroom terlebih dahulu, lalu Anda bisa menambah/menghapus foto galeri kapan saja saat mode edit.</p>
    </div>
@endif
<div>
    <label class="text-sm font-medium text-brown-800">Google Maps Embed (iframe)</label>
    <textarea name="gmaps_embed" rows="2" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('gmaps_embed', $showroom->gmaps_embed ?? '') }}</textarea>
</div>
<div>
    <label class="text-sm font-medium text-brown-800">URL Google Maps</label>
    <input type="text" name="gmaps_url" value="{{ old('gmaps_url', $showroom->gmaps_url ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
    <div>
        <label class="text-sm font-medium text-brown-800">Latitude</label>
        <input type="number" step="0.0000001" name="latitude" value="{{ old('latitude', $showroom->latitude ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Longitude</label>
        <input type="number" step="0.0000001" name="longitude" value="{{ old('longitude', $showroom->longitude ?? '') }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div class="flex items-end pb-2">
        <label class="flex items-center gap-2 text-sm font-medium text-brown-800">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $showroom->is_active ?? true)) class="rounded border-wood-400/30">
            Aktifkan Showroom
        </label>
    </div>
</div>
