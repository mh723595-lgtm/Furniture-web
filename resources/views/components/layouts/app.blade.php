<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-seo-meta :title="$title ?? null" :description="$description ?? null" :keywords="$keywords ?? null" :image="$image ?? null" />

    @if(isset($jsonLd))
        <script type="application/ld+json">{!! $jsonLd !!}</script>
    @endif

    <link rel="icon" href="{{ \App\Models\Setting::get('favicon') ? asset('storage/'.\App\Models\Setting::get('favicon')) : '/favicon.ico' }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream-50 antialiased">

    @include('partials.navbar')

    <main>
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 class="fixed top-24 left-1/2 z-[60] -translate-x-1/2 rounded-2xl bg-olive-500/95 px-6 py-3 text-white shadow-xl backdrop-blur-md">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 class="fixed top-24 left-1/2 z-[60] -translate-x-1/2 rounded-2xl bg-red-500/95 px-6 py-3 text-white shadow-xl backdrop-blur-md">
                {{ session('error') }}
            </div>
        @endif

        {{ $slot }}
    </main>

    @include('partials.footer')
    @include('partials.whatsapp-float')

</body>
</html>
