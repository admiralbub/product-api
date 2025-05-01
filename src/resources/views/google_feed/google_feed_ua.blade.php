<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
    <channel>
        <title>Асортимент магазину</title>
        <link>{{config('app.url')}}</link>
        <description>У цьому файлі перелічені товари магазину</description>

        @foreach($products as $product)
            <item>
                <g:id>{{ $product->id }}</g:id>
                @if($product->categories->first->getRootCategory())
                    <g:title>{{ $product->categories->first->getRootCategory()->name_ua}} {{ $product->name_ua }}</g:title>
                @else 
                     <g:title></g:title>
                @endif
               
                @if($product->categories->first->getRootCategory())
                    <g:description>{{ $product->categories->first->getRootCategory()->name_ua ?? ''}} від компанії {{ $product->brand->name_ua ?? 'Немає'  }}</g:description>
                @else 
                     <g:description></g:description>
                @endif
                <g:link>{{ route('product.view', ['slug' => $product->slug]) }}</g:link>
                <g:image_link>{{ asset($product->img) }}</g:image_link>
                <g:condition>new</g:condition>
                <g:availability>in stock</g:availability>


                @if($product->categories->first->getRootCategory())
                    <g:product_type>{{ $product->categories->first->getRootCategory()->parent->name_ua ?? ''}} > {{$product->categories->first->getRootCategory()->name_ua ?? ''}} > {{$product->name_ua}} </g:product_type>
                @else
                    <g:product_type></g:product_type>
                @endif
                 <g:google_product_category></g:google_product_category>
                
                 <g:price>{{ $product->packs()->min('volume') * $product->price }} UAH</g:price>
                <g:brand> {{ $product->brand->name_ua ?? 'Немає' }}</g:brand>
            </item>
        @endforeach
    </channel>
</rss>

