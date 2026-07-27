<x-layouts.admin title="FAQ">
    <div class="flex items-center justify-between">
        <h2 class="font-display text-lg font-semibold text-brown-800">Daftar FAQ</h2>
        <a href="{{ route('admin.faqs.create') }}" class="btn-primary !px-4 !py-2 text-sm">+ Tambah FAQ</a>
    </div>
    <div class="glass-card mt-6 overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-wood-400/10 text-xs uppercase text-brown-800/50">
                <tr><th class="px-5 py-3">Pertanyaan</th><th class="px-5 py-3">Kategori</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Aksi</th></tr>
            </thead>
            <tbody class="divide-y divide-wood-400/10">
                @forelse($faqs as $faq)
                    <tr>
                        <td class="px-5 py-3 font-medium text-brown-800">{{ $faq->question }}</td>
                        <td class="px-5 py-3 text-brown-800/60">{{ $faq->category ?? '-' }}</td>
                        <td class="px-5 py-3">
                            <span class="rounded-full px-3 py-1 text-xs font-medium {{ $faq->is_active ? 'bg-olive-500/10 text-olive-600' : 'bg-red-500/10 text-red-500' }}">
                                {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" class="rounded-lg bg-wood-500/10 px-3 py-1.5 text-xs font-medium text-wood-600">Edit</a>
                                <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-lg bg-red-500/10 px-3 py-1.5 text-xs font-medium text-red-500">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-brown-800/50">Belum ada FAQ.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $faqs->links() }}</div>
</x-layouts.admin>
