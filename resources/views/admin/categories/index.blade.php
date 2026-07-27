<x-layouts.admin title="Kategori">
    <div class="flex items-center justify-between">
        <h2 class="font-display text-lg font-semibold text-brown-800">Daftar Kategori</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn-primary !px-4 !py-2 text-sm">+ Tambah Kategori</a>
    </div>

    <div class="glass-card mt-6 overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-wood-400/10 text-xs uppercase text-brown-800/50">
                <tr>
                    <th class="px-5 py-3">Nama</th>
                    <th class="px-5 py-3">Slug</th>
                    <th class="px-5 py-3">Produk</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-wood-400/10">
                @forelse($categories as $category)
                    <tr>
                        <td class="px-5 py-3 font-medium text-brown-800">{{ $category->name }}</td>
                        <td class="px-5 py-3 text-brown-800/60">{{ $category->slug }}</td>
                        <td class="px-5 py-3">{{ $category->products_count }}</td>
                        <td class="px-5 py-3">
                            <span class="rounded-full px-3 py-1 text-xs font-medium {{ $category->is_active ? 'bg-olive-500/10 text-olive-600' : 'bg-red-500/10 text-red-500' }}">
                                {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-lg bg-wood-500/10 px-3 py-1.5 text-xs font-medium text-wood-600 hover:bg-wood-500/20">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-lg bg-red-500/10 px-3 py-1.5 text-xs font-medium text-red-500 hover:bg-red-500/20">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-brown-800/50">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $categories->links() }}</div>
</x-layouts.admin>
