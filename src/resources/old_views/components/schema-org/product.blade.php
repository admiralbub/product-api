@props([
    'product',
    'feedbacks'
])
<script type="application/ld+json">
    "@context": "https://schema.org/",
    "@type" : "Product",
    @if($product->feedback->count() != 0)
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "{{$product->feedback->avg('rating')}}",
            "reviewCount": "{{$product->feedback->count()}}",
            "bestRating": "5",
            "worstRating": "1"
        },
    @endif

    "name": "{{$product->name}}",
    "image": "{{ asset($product->image)}}",
    "offers": {
        "@type": "Offer",
        "url":"{{route('product.view',$product->slug)}}",
        "availability": "{{$product->status == 1 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock'}}",
        @if ($product->stocks)
            "price": "{{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price_stock) }} {{__("uah")}}",
        @else
            "price": "{{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price) }} {{__("uah")}}",
        @endif  
        
        "priceCurrency": "UAH"
    }@if(count($feedbacks) > 0) , @endif
    @if(count($feedbacks) > 0)
    "review": [
        @foreach($feedbacks as $feedback)
        {
            "@type": "Review",
            "author": {"@type": "Person", "name": "{{$feedback->name}}"},
            "datePublished": "{{$feedback->created_at}}",
            "reviewBody": "{{$feedback->message}}",
            "reviewRating": {
                "@type": "Rating",
                "bestRating": "5",
                "ratingValue": {{$feedback->rating}},
                "worstRating": "1"
            }
        }{!! $loop->iteration < $feedback->count() ? ',' : '' !!}
        @endforeach]
    @endif
</script>