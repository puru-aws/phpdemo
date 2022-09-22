<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{$site_url}}</loc>
    </url>
    <url>
        <loc>{{$site_url}}</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/properties</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/featured</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/sale</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/rent</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/agents</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/testimonials</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/about-us</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/contact-us</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    
    @foreach($properties as $i => $property)
    <url>
        <loc>{{ url('properties/'.$property->property_slug.'/'.Crypt::encryptString($property->id)) }}</loc>
     </url>  
    @endforeach 
     
</urlset>