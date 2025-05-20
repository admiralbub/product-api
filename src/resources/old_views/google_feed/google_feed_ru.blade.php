<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
    <channel>
        <title>Ассортимент магазина</title>
        <link>{{config('app.url')}}</link>
        <description>В этом файле перечислены товары магазина</description>

        @foreach($products as $product)
            <item>
                <g:id>{{ $product->id }}</g:id>
                @if($product->categories->first->getRootCategory())
                    <g:title>{{ $product->categories->first->getRootCategory()->parent ? $product->categories->first->getRootCategory()->parent->name_ru : $product->categories->first->getRootCategory()->name_ru }} {{ $product->name_ru }}</g:title>
                @else 
                     <g:title></g:title>
                @endif
               
                @if($product->categories->first->getRootCategory())
                    <g:description>{{ $product->categories->first->getRootCategory()->parent ? $product->categories->first->getRootCategory()->parent->name_ru : $product->categories->first->getRootCategory()->name_ru }} от компании {{ $product->brand->name_ru}}</g:description>
                @else 
                     <g:description></g:description>
                @endif
                <g:link>{{ route('product.view', ['slug' => $product->slug]) }}</g:link>
                <g:image_link>{{ asset($product->img) }}</g:image_link>
                <g:condition>new</g:condition>
                <g:availability>in stock</g:availability>


           
                
                <g:price>{{ $product->packs()->min('volume') * $product->price }} UAH</g:price>
                <g:brand>{{ $product->brand->name_ru }}</g:brand>
            </item>
        @endforeach
    </channel>
</rss>
