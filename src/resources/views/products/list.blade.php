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
    <div class="container mb-5">
        
        <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
        <div class="mt-2 category-heading">
            @if($seo_attr_filter)
                <h1 class="fs-2">{{$seo_attr_filter->parseH1($category->id,$selectedFilter["brand"][0] ?? 0,attr_feature($selectedFilter) ?? 0,attr_feature($selectedFilter) ?? 0)}}</h1>
            @else

                <h1 class="fs-2">{{$category->h1_parsed ? $category->h1_parsed : $category->h1}}</h1>
            @endif
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
                            <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-sm-2 row-cols-2 mb-30 card_products">
                                @foreach($products as $product)
                                    <x-products.product :product="$product"></x-products.product>
                                @endforeach
                            </div>
                            <div class="mt-3">
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
                    <div class="mt-3">
                        {!! preg_replace('#<h1([^>]*)>(.*)</h1>#m','<h2$1>$2</h2>', $seo_attr_filter->description) !!}
                    </div>
                
                @endif

            @else
                @if($category->description)
                    <div class="mt-3">
                        {!! preg_replace('#<h1([^>]*)>(.*)</h1>#m','<h2$1>$2</h2>', $category->description) !!}
                    </div>
                @endif
            @endif
        @endif
    </div>

</x-layouts.app>