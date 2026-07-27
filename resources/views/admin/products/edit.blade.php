<x-layouts.admin title="Edit Produk">
    <div class="glass-card mx-auto max-w-3xl p-6">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            @include('admin.products._form')
            <button type="submit" class="btn-primary w-full">Perbarui Produk</button>
        </form>
    </div>
</x-layouts.admin>
