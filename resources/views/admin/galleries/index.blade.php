<x-layouts.admin title="Galeri">
    <div class="flex items-center justify-between">
        <h2 class="font-display text-lg font-semibold text-brown-800">Daftar Galeri</h2>
        <a href="{{ route('admin.galleries.create') }}" class="btn-primary !px-4 !py-2 text-sm">+ Tambah Galeri</a>
    </div>
    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-4 lg:grid-cols-6">
        @forelse($galleries as $gallery)
            <div class="glass-card overflow-hidden">
                <img src="{{ asset('storage/'.$gallery->image_path) }}" class="h-32 w-full object-cover">
                <div class="p-3">
                    <p class="truncate text-xs font-medium text-brown-800">{{ $gallery->title ?: '(Tanpa judul)' }}</p>
                    <div class="mt-2 flex gap-2">
                        <a href="{{ route('admin.galleries.edit', $gallery) }}" class="rounded-lg bg-wood-500/10 px-2 py-1 text-xs text-wood-600">Edit</a>
                        <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="rounded-lg bg-red-500/10 px-2 py-1 text-xs text-red-500">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full py-8 text-center text-brown-800/50">Belum ada galeri.</p>
        @endforelse
    </div>
    <div class="mt-4">{{ $galleries->links() }}</div>
</x-layouts.admin>
