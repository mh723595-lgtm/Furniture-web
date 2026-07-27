<x-layouts.admin title="Profil Saya">
    <div class="mx-auto max-w-2xl space-y-6">
        <div class="glass-card p-6">
            <h2 class="font-display font-semibold text-brown-800">Informasi Profil</h2>
            <form method="POST" action="{{ route('admin.profile.update') }}" class="mt-4 space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="text-sm font-medium text-brown-800">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="text-sm font-medium text-brown-800">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="text-sm font-medium text-brown-800">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <button type="submit" class="btn-primary w-full">Perbarui Profil</button>
            </form>
        </div>

        <div class="glass-card p-6">
            <h2 class="font-display font-semibold text-brown-800">Ubah Password</h2>
            <form method="POST" action="{{ route('admin.profile.password') }}" class="mt-4 space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="text-sm font-medium text-brown-800">Password Saat Ini</label>
                    <input type="password" name="current_password" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="text-sm font-medium text-brown-800">Password Baru</label>
                    <input type="password" name="password" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="text-sm font-medium text-brown-800">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
                </div>
                <button type="submit" class="btn-primary w-full">Perbarui Password</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
