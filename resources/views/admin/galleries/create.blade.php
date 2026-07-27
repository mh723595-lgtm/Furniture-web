<x-layouts.admin title="Tambah Galeri">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @include('admin.galleries._form')
            <button type="submit" class="btn-primary w-full">Simpan Galeri</button>
        </form>
    </div>
</x-layouts.admin>
