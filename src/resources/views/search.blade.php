<x-layouts.app  
    :title="__('Search')"
    :descriptions="__('Search')"
    :keywords="__('Search')"
    no_index=1>

    <x-block.hero :h1="__('Search').' - '.$search" :breadcrumbs="''"></x-x-block.hero>
    <div class="container mb-5 mt-5">
       
        <div class="mt-3">
            @if($products)
                <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-sm-2 row-cols-2 mb-30 card_products">
                    @foreach($products as $product)
                        <x-products.product :product="$product"></x-products.product>
                    @endforeach
                </div>
            @else
                <p class="fs-5">{{__('Unfortunately there are no products in this category')}}</p>
            @endif    
            {!! $products->links() !!}
        </div>
       
    </div>
</x-layouts.app>