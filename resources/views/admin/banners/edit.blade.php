<x-layouts.admin title="Edit Banner">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            @include('admin.banners._form')
            <button type="submit" class="btn-primary w-full">Perbarui Banner</button>
        </form>
    </div>
</x-layouts.admin>
