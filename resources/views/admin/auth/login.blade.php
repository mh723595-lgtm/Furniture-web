<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Furnisha</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-gradient-to-br from-beige-100 via-cream-100 to-wood-400/20 px-4">
    <div class="glass-card w-full max-w-sm p-8">
        <h1 class="font-display text-xl font-bold text-brown-800">Admin Login</h1>
        <p class="mt-1 text-sm text-brown-800/60">Masuk untuk mengelola katalog furniture Anda.</p>

        @if($errors->any())
            <div class="mt-4 rounded-xl bg-red-500/10 px-4 py-3 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="text-sm font-medium text-brown-800">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-brown-800">Password</label>
                <input type="password" name="password" required
                       class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
            </div>
            <label class="flex items-center gap-2 text-sm text-brown-800/70">
                <input type="checkbox" name="remember" class="rounded border-wood-400/30">
                Ingat saya
            </label>
            <button type="submit" class="btn-primary w-full">Masuk</button>
        </form>
    </div>
</body>
</html>
