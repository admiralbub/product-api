@php
    if($seo_attr_filter) {
        $title =  $seo_attr_filter->parseMetaTitle($category->id,$selectedFilter["brand"][0] ?? 0,attr_feature($selectedFilter) ?? 0,attr_feature($selectedFilter) ?? 0);
        $description = $seo_attr_filter->parseMetaDescription($category->id,$selectedFilter["brand"][0] ?? 0,attr_feature($selectedFilter) ?? 0,attr_feature($selectedFilter) ?? 0);
        $keywords =  $seo_attr_filter->parseMetaKeywords($category->id,$selectedFilter["brand"][0] ?? 0,attr_feature($selectedFilter) ?? 0,attr_feature($selectedFilter) ?? 0);
    } else {
        $title = $category->meta_title_parsed ? $category->meta_title_parsed : $category->meta_title;
        $description = $category->meta_title_parsed ? $category->meta_title_parsed : $category->meta_title;
        $keywords =  $category->meta_title_parsed ? $category->meta_title_parsed : $category->meta_title;
    }   
    



    if($selectedFilter) {
        if($seo_attr_filter) {
            if($seo_attr_filter->no_index == 0) {
                $no_index = 0;
            } else {
                $no_index = 1;
            }
        } else {
            $no_index = 1;
        }
    } else {
        $no_index = 0;
    }

@endphp
<x-layouts.app  
    :title="$title"
    :descriptions="$description"
    :keywords="$keywords"
    :no_index=$no_index>
    @if($seo_attr_filter)
        <x-block.hero 
            :h1="$seo_attr_filter->parseH1(
                $category->id, 
                $selectedFilter['brand'][0] ?? 0, 
                attr_feature($selectedFilter) ?? 0, 
                attr_feature($selectedFilter) ?? 0
            )" 
            :breadcrumbs="$breadcrumbs"
        />
    @else
        <x-block.hero 
            :h1="$category->h1_parsed ? $category->h1_parsed : $category->h1" 
            :breadcrumbs="$breadcrumbs" 
        />
    @endif
    <div class="container mb-5">
        
        
        <div class="mt-2 category-heading">
            
            <div class="mt-4">
                @auth
                
                    @if(!empty(auth()->user()->permissions))
                        @if($seo_attr_filter)
                            <a href="/admin/seo-filters/{{$seo_attr_filter->id}}/edit" target="_blank" class="primary">
                                <i class="bi bi-filter"></i>

                                <span>{{__('Edit seo filter')}}</span>
                            </a>
                            <br>
                        @endif
                        <a href="/admin/categories/{{$category->id}}/edit" target="_blank" class="primary">
                            <i class="bi bi-pencil-fill"></i>

                            <span>{{__('Edit')}}</span>
                        </a>
                    @endif
                @endif
            </div>
        </div>
        <div class="category-lists mt-3 mb-4">
            <div class="row">
                <div class="col col-lg-3 col-12">
                    <x-products.filter :brands="$brands ?? null" :price="$price" :selectedFilter="$selectedFilter" :attrs="$attrs" :category="$category->children"></x-products.filter>
                </div>
                <div class="col col-lg-9 col-12">
                    <div class="px-4">
                        <x-products.sort></x-products.sort>
                        @if($products)
                           
                            <div class="getProductAjax row product-row" id="products-container">
                                <!-- Apple Card -->
                                @foreach($products as $product)
                                    <x-products.product :product="$product"></x-products.product>
                                @endforeach
                                
                            </div>

                            <div class="text-center">
                                <button  id="LoadProduct" class="btn btn-primary @if(empty($products->nextPageUrl())) d-none @endif" data-url="{{$products->nextPageUrl()}}">
                                {{__('Show more')}}
                                </button>
                            </div>
                            
                    
                            <div class="mt-3" id="pagination_products">
                                {{ $products->links() }}
                            </div>
                        @else
                            <p class="fs-5">{{__('Unfortunately there are no products in this category')}}</p>
                        @endif
                        
                    </div>
                   
                </div>
            </div>  
        </div> 
        @if(!request()->has('page'))
            @if($selectedFilter) 
                @if ($seo_attr_filter)
                    <div class="mt-3 page_description">
                        {!! preg_replace('#<h1([^>]*)>(.*)</h1>#m','<h2$1>$2</h2>', $seo_attr_filter->description) !!}
                    </div>
                
                @endif

            @else
                @if($category->description)
                    <div class="mt-3 page_description">
                        {!! preg_replace('#<h1([^>]*)>(.*)</h1>#m','<h2$1>$2</h2>', $category->description) !!}
                    </div>
                @endif
            @endif
        @endif
    </div>

</x-layouts.app>