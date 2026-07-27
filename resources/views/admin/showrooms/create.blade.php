<x-layouts.admin title="Tambah Showroom">
    <div class="glass-card mx-auto max-w-3xl p-6">
        <form method="POST" action="{{ route('admin.showrooms.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @include('admin.showrooms._form')
            <button type="submit" class="btn-primary w-full">Simpan Showroom</button>
        </form>
    </div>
</x-layouts.admin>
