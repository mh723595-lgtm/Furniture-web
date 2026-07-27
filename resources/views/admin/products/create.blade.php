<x-layouts.admin title="Tambah Produk">
    <div class="glass-card mx-auto max-w-3xl p-6">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @include('admin.products._form')
            <button type="submit" class="btn-primary w-full">Simpan Produk</button>
        </form>
    </div>
</x-layouts.admin>
