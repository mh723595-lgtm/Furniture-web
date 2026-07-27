<x-layouts.admin title="Edit Galeri">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            @include('admin.galleries._form')
            <button type="submit" class="btn-primary w-full">Perbarui Galeri</button>
        </form>
    </div>
</x-layouts.admin>
