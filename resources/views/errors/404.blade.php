<x-layouts.app :title="'Halaman Tidak Ditemukan'">
    <div class="mx-auto flex min-h-[60vh] max-w-2xl flex-col items-center justify-center px-4 text-center">
        <div class="glass-card p-10">
            <h1 class="font-display text-6xl font-bold text-wood-500">404</h1>
            <p class="mt-4 text-lg font-semibold text-brown-800">Halaman yang Anda cari tidak ditemukan</p>
            <p class="mt-2 text-sm text-brown-800/60">Mungkin halaman telah dipindahkan atau tidak lagi tersedia.</p>
            <a href="{{ route('home') }}" class="btn-primary mt-6">Kembali ke Beranda</a>
        </div>
    </div>
</x-layouts.app>
