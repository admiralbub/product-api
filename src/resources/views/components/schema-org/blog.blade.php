@props([
    'blog',
])

<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": "{{$blog->name}}",
        "description": "",
        "image": "{{$blog->img}}", 
        "author": {
            "@type": "Person",
            "name": "{{$blog->author->name}}"
        },
        "publisher": {
            "@type": "Organization",
            "name": "{{config('app.name')}}",
            "logo": {
                "@type": "ImageObject",
                "url": "{{settings('logo_site')}}"
            }
        },
        "datePublished": "{{$blog->created_at->format('d.m.Y')}}",
        "dateModified": "{{$blog->updated_at->format('d.m.Y')}}",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{route('blog.index',['slug'=>$blog->slug])}}"
        }
    }
</script>