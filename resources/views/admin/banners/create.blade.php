<x-layouts.admin title="Tambah Banner">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @include('admin.banners._form')
            <button type="submit" class="btn-primary w-full">Simpan Banner</button>
        </form>
    </div>
</x-layouts.admin>
