<x-layouts.admin title="Edit Showroom">
    <div class="glass-card mx-auto max-w-3xl p-6">
        <form method="POST" action="{{ route('admin.showrooms.update', $showroom) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            @include('admin.showrooms._form')
            <button type="submit" class="btn-primary w-full">Perbarui Showroom</button>
        </form>
    </div>
</x-layouts.admin>
