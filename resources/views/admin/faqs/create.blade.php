<x-layouts.admin title="Tambah FAQ">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.faqs.store') }}" class="space-y-4">
            @csrf
            @include('admin.faqs._form')
            <button type="submit" class="btn-primary w-full">Simpan FAQ</button>
        </form>
    </div>
</x-layouts.admin>
