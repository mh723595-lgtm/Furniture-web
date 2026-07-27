@php
    $siteName = \App\Models\Setting::get('site_name', 'Furnisha');
    $address = \App\Models\Setting::get('address');
    $phone = \App\Models\Setting::get('phone');
    $email = \App\Models\Setting::get('email');
@endphp
<footer class="mt-20 border-t border-wood-400/10 bg-beige-100/60">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-4">
            <div>
                <span class="font-display text-xl font-bold text-wood-600">{{ $siteName }}</span>
                <p class="mt-3 text-sm leading-relaxed text-brown-800/70">
                    Furniture premium berkualitas tinggi untuk rumah dan keluarga Indonesia. Desain hangat, material terbaik, harga bersahabat.
                </p>
            </div>
            <div>
                <h3 class="font-display font-semibold text-brown-800">Navigasi</h3>
                <ul class="mt-3 space-y-2 text-sm text-brown-800/70">
                    <li><a href="{{ route('catalog.index') }}" class="hover:text-wood-600">Katalog Produk</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-wood-600">Galeri</a></li>
                    <li><a href="{{ route('showroom.index') }}" class="hover:text-wood-600">Showroom</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-wood-600">Tentang Kami</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-display font-semibold text-brown-800">Bantuan</h3>
                <ul class="mt-3 space-y-2 text-sm text-brown-800/70">
                    <li><a href="{{ route('faq') }}" class="hover:text-wood-600">FAQ</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-wood-600">Kontak Kami</a></li>
                    <li><a href="{{ route('privacy-policy') }}" class="hover:text-wood-600">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-display font-semibold text-brown-800">Hubungi Kami</h3>
                <ul class="mt-3 space-y-2 text-sm text-brown-800/70">
                    @if($address)<li>{{ $address }}</li>@endif
                    @if($phone)<li>Telepon: {{ $phone }}</li>@endif
                    @if($email)<li>Email: {{ $email }}</li>@endif
                </ul>
            </div>
        </div>
        <div class="mt-10 border-t border-wood-400/10 pt-6 text-center text-xs text-brown-800/60">
            &copy; {{ date('Y') }} {{ $siteName }}. Seluruh hak cipta dilindungi.
        </div>
    </div>
</footer>
