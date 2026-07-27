<x-layouts.admin title="Showroom">
    <div class="flex items-center justify-between">
        <h2 class="font-display text-lg font-semibold text-brown-800">Daftar Showroom</h2>
        <a href="{{ route('admin.showrooms.create') }}" class="btn-primary !px-4 !py-2 text-sm">+ Tambah Showroom</a>
    </div>
    <div class="glass-card mt-6 overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-wood-400/10 text-xs uppercase text-brown-800/50">
                <tr><th class="px-5 py-3">Nama</th><th class="px-5 py-3">Kota</th><th class="px-5 py-3">WhatsApp</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Aksi</th></tr>
            </thead>
            <tbody class="divide-y divide-wood-400/10">
                @forelse($showrooms as $showroom)
                    <tr>
                        <td class="px-5 py-3 font-medium text-brown-800">{{ $showroom->name }}</td>
                        <td class="px-5 py-3 text-brown-800/60">{{ $showroom->city }}</td>
                        <td class="px-5 py-3 text-brown-800/60">{{ $showroom->whatsapp_number }}</td>
                        <td class="px-5 py-3">
                            <span class="rounded-full px-3 py-1 text-xs font-medium {{ $showroom->is_active ? 'bg-olive-500/10 text-olive-600' : 'bg-red-500/10 text-red-500' }}">
                                {{ $showroom->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.showrooms.edit', $showroom) }}" class="rounded-lg bg-wood-500/10 px-3 py-1.5 text-xs font-medium text-wood-600">Edit</a>
                                <form method="POST" action="{{ route('admin.showrooms.destroy', $showroom) }}" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="rounded-lg bg-red-500/10 px-3 py-1.5 text-xs font-medium text-red-500">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-brown-800/50">Belum ada showroom.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $showrooms->links() }}</div>
</x-layouts.admin>
