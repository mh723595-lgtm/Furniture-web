<x-layouts.admin title="Produk">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="font-display text-lg font-semibold text-brown-800">Daftar Produk</h2>
        <a href="{{ route('admin.products.create') }}" class="btn-primary !px-4 !py-2 text-sm">+ Tambah Produk</a>
    </div>

    <form method="GET" class="glass-card mt-4 flex flex-wrap gap-3 p-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="flex-1 min-w-[160px] rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2 text-sm">
        <select name="category" class="rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2 text-sm">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="status" class="rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="active" @selected(request('status') === 'active')>Aktif</option>
            <option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option>
            <option value="draft" @selected(request('status') === 'draft')>Draft</option>
        </select>
        <button type="submit" class="btn-secondary !px-4 !py-2 text-sm">Filter</button>
    </form>

    <div class="glass-card mt-6 overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-wood-400/10 text-xs uppercase text-brown-800/50">
                <tr>
                    <th class="px-5 py-3">Produk</th>
                    <th class="px-5 py-3">Kategori</th>
                    <th class="px-5 py-3">Harga</th>
                    <th class="px-5 py-3">Stok</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-wood-400/10">
                @forelse($products as $product)
                    <tr>
                        <td class="flex items-center gap-3 px-5 py-3">
                            <img src="{{ $product->thumbnail ? asset('storage/'.$product->thumbnail) : 'https://placehold.co/60x60/ede4d3/7c5738?text=%20' }}" class="h-10 w-10 rounded-lg object-cover">
                            <span class="font-medium text-brown-800">{{ $product->name }}</span>
                        </td>
                        <td class="px-5 py-3 text-brown-800/60">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-5 py-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-5 py-3">{{ $product->stock }}</td>
                        <td class="px-5 py-3">
                            <span class="rounded-full px-3 py-1 text-xs font-medium
                                {{ $product->status === 'active' ? 'bg-olive-500/10 text-olive-600' : ($product->status === 'draft' ? 'bg-yellow-500/10 text-yellow-600' : 'bg-red-500/10 text-red-500') }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="rounded-lg bg-wood-500/10 px-3 py-1.5 text-xs font-medium text-wood-600 hover:bg-wood-500/20">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-lg bg-red-500/10 px-3 py-1.5 text-xs font-medium text-red-500 hover:bg-red-500/20">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-8 text-center text-brown-800/50">Belum ada produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $products->links() }}</div>
</x-layouts.admin>
