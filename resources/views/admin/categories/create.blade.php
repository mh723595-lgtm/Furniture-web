<x-layouts.admin title="Tambah Kategori">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @include('admin.categories._form')
            <button type="submit" class="btn-primary w-full">Simpan Kategori</button>
        </form>
    </div>
</x-layouts.admin>
