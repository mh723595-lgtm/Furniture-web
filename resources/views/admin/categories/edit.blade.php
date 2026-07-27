<x-layouts.admin title="Edit Kategori">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            @include('admin.categories._form')
            <button type="submit" class="btn-primary w-full">Perbarui Kategori</button>
        </form>
    </div>
</x-layouts.admin>
