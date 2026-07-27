@php
    $siteName = \App\Models\Setting::get('site_name', 'Furnisha');
    $logo = \App\Models\Setting::get('logo');
    $isHome = request()->routeIs('home');
@endphp
@if($isHome)
    {{-- Home page: navbar starts fully transparent over the full-screen hero,
         then fades into the usual glass background once the user scrolls past it. --}}
    <header x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = window.scrollY > 40"
            class="fixed inset-x-0 top-0 z-50 transition-colors duration-500"
            :class="scrolled ? 'glass-nav shadow-md shadow-brown-800/5' : 'bg-transparent'">
        @include('partials.navbar-inner')
    </header>
@else
    {{-- Other pages: no hero behind it, keep the navbar solid/readable at all times. --}}
    <header x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = window.scrollY > 20"
            class="glass-nav sticky top-0 z-50 transition-shadow" :class="scrolled ? 'shadow-md shadow-brown-800/5' : ''">
        @include('partials.navbar-inner')
    </header>
@endif
