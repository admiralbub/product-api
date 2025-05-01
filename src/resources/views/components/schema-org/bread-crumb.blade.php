@props([
    'breadcrumbs',
])

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "{{__('Home')}}",
      "item": "{{ route('index') }}"
    }
    @if(isset($breadcrumbs[0]['type']) && !empty($breadcrumbs[0]['type'] == "page"))
      @foreach($breadcrumbs as $index => $breadcrumb)

        @if (isset($breadcrumb['parent']))
          ,
          {
            "@type": "ListItem",
            "position": {{ $index + 2 }},
            "name": "{{ $breadcrumb['parent']['name'] }}",
            "item": "{{ route($breadcrumb['parent']['route']) }}"
          },
          {
            "@type": "ListItem",
            "position": {{ $index + 3 }},
            "name": "{{ $breadcrumb['name'] }}",
            "item": "{{ $breadcrumb['slug'] ? route($breadcrumb['route'], ['slug' => $breadcrumb['slug']]) : route($breadcrumb['route'], ['id' => $breadcrumb['id']]) }}"
          }
        @else
          ,
          {
            "@type": "ListItem",
            "position": {{ $index + 2 }},
            "name": "{{ $breadcrumb['name'] }}",
            "item": "{{ $breadcrumb['slug'] ? route($breadcrumb['route'], ['slug' => $breadcrumb['slug']]) : route($breadcrumb['route'], ['id' => $breadcrumb['id']]) }}"
          }
        @endif
      @endforeach
    @else
      @foreach($breadcrumbs as $i => $breadcrumb)
        ,
        {
          "@type": "ListItem",
          "position": {{ $i + 2 }},
          "name": "{{ $breadcrumb['name'] }}",
          "item": "{{ $breadcrumb['slug'] ? route($breadcrumb['route'], ['slug' => $breadcrumb['slug']]) : route($breadcrumb['route'], ['id' => $breadcrumb['id']]) }}"
        }
      @endforeach
      @if(isset($breadcrumb['name_product']))
        ,
        {
          "@type": "ListItem",
          "position": {{ $breadcrumbs->count() + 2 }},
          "name": "{{ $breadcrumb['name_product'] }}",
          "item": "{{ $breadcrumb['slug'] ? route($breadcrumb['route'], ['slug' => $breadcrumb['slug']]) : route($breadcrumb['route'], ['id' => $breadcrumb['id']]) }}"
        }
      @endif
    @endif
  ]
}
</script>