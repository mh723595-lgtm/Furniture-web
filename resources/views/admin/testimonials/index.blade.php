<x-layouts.admin title="Testimoni">
    <div class="flex items-center justify-between">
        <h2 class="font-display text-lg font-semibold text-brown-800">Daftar Testimoni</h2>
        <a href="{{ route('admin.testimonials.create') }}" class="btn-primary !px-4 !py-2 text-sm">+ Tambah Testimoni</a>
    </div>
    <div class="glass-card mt-6 overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-wood-400/10 text-xs uppercase text-brown-800/50">
                <tr><th class="px-5 py-3">Pelanggan</th><th class="px-5 py-3">Rating</th><th class="px-5 py-3">Produk</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Aksi</th></tr>
            </thead>
            <tbody class="divide-y divide-wood-400/10">
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td class="px-5 py-3 font-medium text-brown-800">{{ $testimonial->customer_name }}</td>
                        <td class="px-5 py-3">{{ $testimonial->rating }} / 5</td>
                        <td class="px-5 py-3 text-brown-800/60">{{ $testimonial->product->name ?? '-' }}</td>
                        <td class="px-5 py-3">
                            <span class="rounded-full px-3 py-1 text-xs font-medium {{ $testimonial->is_active ? 'bg-olive-500/10 text-olive-600' : 'bg-red-500/10 text-red-500' }}">
                                {{ $testimonial->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="rounded-lg bg-wood-500/10 px-3 py-1.5 text-xs font-medium text-wood-600">Edit</a>
                                <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-lg bg-red-500/10 px-3 py-1.5 text-xs font-medium text-red-500">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-brown-800/50">Belum ada testimoni.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $testimonials->links() }}</div>
</x-layouts.admin>
