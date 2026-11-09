{{-- The XML declaration is echoed, not written literally. Blade copies
     literal text straight into the compiled PHP file, and where
     short_open_tag is on the declaration is read as a PHP open tag and
     the page 500s. Inside an echo it is just a string. --}}
{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
@isset($url['lastmod'])
        <lastmod>{{ $url['lastmod']->toAtomString() }}</lastmod>
@endisset
        <changefreq>{{ $url['freq'] }}</changefreq>
        <priority>{{ $url['priority'] }}</priority>
    </url>
@endforeach
</urlset>
