{!! '<'.'?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('catalog.index') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('gallery.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ route('showroom.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('about') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{ route('faq') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{ route('contact.index') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    @foreach($categories as $category)
    <url>
        <loc>{{ route('category.show', $category->slug) }}</loc>
        <lastmod>{{ $category->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
    @foreach($products as $product)
    <url>
        <loc>{{ route('product.show', $product->slug) }}</loc>
        <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
    @foreach($showrooms as $showroom)
    <url>
        <loc>{{ route('showroom.show', $showroom->slug) }}</loc>
        <lastmod>{{ $showroom->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset>
