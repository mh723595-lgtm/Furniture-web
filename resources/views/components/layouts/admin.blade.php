@php
    $navItems = [
        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'match' => 'admin.dashboard'],
        ['route' => 'admin.categories.index', 'label' => 'Kategori', 'match' => 'admin.categories.*'],
        ['route' => 'admin.products.index', 'label' => 'Produk', 'match' => 'admin.products.*'],
        ['route' => 'admin.galleries.index', 'label' => 'Galeri', 'match' => 'admin.galleries.*'],
        ['route' => 'admin.banners.index', 'label' => 'Banner', 'match' => 'admin.banners.*'],
        ['route' => 'admin.showrooms.index', 'label' => 'Showroom', 'match' => 'admin.showrooms.*'],
        ['route' => 'admin.testimonials.index', 'label' => 'Testimoni', 'match' => 'admin.testimonials.*'],
        ['route' => 'admin.faqs.index', 'label' => 'FAQ', 'match' => 'admin.faqs.*'],
        ['route' => 'admin.settings.general', 'label' => 'Pengaturan Umum', 'match' => 'admin.settings.general*'],
        ['route' => 'admin.settings.seo', 'label' => 'Pengaturan SEO', 'match' => 'admin.settings.seo*'],
        ['route' => 'admin.profile.edit', 'label' => 'Profil Saya', 'match' => 'admin.profile.*'],
    ];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Panel' }} | Furnisha Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-cream-100" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        {{-- SIDEBAR --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 transform bg-brown-800 text-cream-100 transition-transform lg:static lg:translate-x-0">
            <div class="flex h-16 items-center gap-2 px-6">
                <span class="font-display text-lg font-bold">Furnisha Admin</span>
            </div>
            <nav class="mt-4 space-y-1 px-3">
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="block rounded-xl px-4 py-2.5 text-sm font-medium transition {{ request()->routeIs($item['match']) ? 'bg-wood-500 text-white' : 'text-cream-100/70 hover:bg-white/10' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        <div class="flex flex-1 flex-col lg:pl-0">
            {{-- TOPBAR --}}
            <header class="flex h-16 items-center justify-between border-b border-wood-400/10 bg-white/70 px-4 backdrop-blur sm:px-6">
                <button @click="sidebarOpen = !sidebarOpen" class="rounded-lg p-2 text-brown-800 hover:bg-brown-800/5 lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="font-display font-semibold text-brown-800">{{ $title ?? 'Dashboard' }}</h1>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="rounded-full bg-brown-800/5 px-4 py-2 text-sm font-medium text-brown-800 hover:bg-brown-800/10">Keluar</button>
                </form>
            </header>

            <main class="flex-1 px-4 py-6 sm:px-6">
                @if(session('success'))
                    <div class="mb-4 rounded-xl bg-olive-500/10 px-4 py-3 text-sm font-medium text-olive-600">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-4 rounded-xl bg-red-500/10 px-4 py-3 text-sm font-medium text-red-600">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="mb-4 rounded-xl bg-red-500/10 px-4 py-3 text-sm text-red-600">
                        <ul class="list-inside list-disc">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
