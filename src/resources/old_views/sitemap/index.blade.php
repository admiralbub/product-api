<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($brands as $brand)
        <url>
            <loc>{{ route('product.brand.show',['slug' => $brand->slug]) }}</loc>
        </url>
    @endforeach
    @foreach ($stocks as $stock)
        <url>
            <loc>{{ route('stock.show',['slug' => $stock->slug]) }}</loc>
        </url>
    @endforeach
    @foreach ($products as $product)
        <url>
            <loc>{{ route('product.view',['slug' => $product->slug]) }}</loc>
        </url>
    @endforeach
    @foreach ($categories as $category)
        <url>
            <loc>{{ route('product.category',['slug' => $category->slug]) }}</loc>
        </url>
    @endforeach
    @foreach ($pages as $page)
        @if($page->url == "/")
            <url>
                <loc>{{config('app.url')}}</loc>
            </url>
        @else
            <url>
                <loc>{{ route('page.pages',['slug' => $page->url]) }}</loc>
            </url>
        @endif
       
    @endforeach
</urlset>