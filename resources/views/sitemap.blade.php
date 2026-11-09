{{-- The angle bracket is concatenated on so the two characters that open a
     PHP tag never sit next to each other in this file. Blade runs the raw
     template through token_get_all() before compiling, and where
     short_open_tag is on that reads the XML declaration as PHP — even inside
     an echo — and the view no longer parses. --}}
{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
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
