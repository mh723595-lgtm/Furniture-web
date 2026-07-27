<x-layouts.admin title="Tambah Testimoni">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @include('admin.testimonials._form')
            <button type="submit" class="btn-primary w-full">Simpan Testimoni</button>
        </form>
    </div>
</x-layouts.admin>
