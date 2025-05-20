<x-layouts.app  
    :title="$brand->meta_title_parsed ? $brand->meta_title_parsed : $brand->meta_title"
    :descriptions="$brand->meta_description_parsed ? $brand->meta_description_parsed : $brand->meta_description"
    :keywords="$brand->meta_keywords_parse ? $brand->meta_keywords_parsed : $brand->meta_keywords"
    :no_index=0>

    <x-block.hero :h1="$brand->h1_parsed ? $brand->h1_parsed : $brand->h1" :breadcrumbs="$breadcrumbs"></x-x-block.hero>

    <div class="show_brand container py-5">
        <div class="row ">
            <div class="col col-lg-3 show_brand_img">
                <img src="{{asset($brand->images)}}">
            </div>
            <div class="col col-lg-9">
                <div class="mt-4 page_description">
                     {!! $brand->description !!}
                </div>
                <div class="mt-4">
                    @auth
                
                        @if(!empty(auth()->user()->permissions))
                            <a href="/admin/brands/{{$brand->id}}/edit" target="_blank" class="primary">
                                <i class="bi bi-pencil-fill"></i>

                                <span>{{__('Edit')}}</span>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
            
        </div>
        <div class="row show_brand-categories mt-5">
            @if($categories_gr->first())
                @foreach($categories_gr->first() as $category)
                    @if($category)
                        <div class="col-12 col-lg-3 brand_category">
                            <a href="{{route('product.category', [$category->slug,'brand-'.$brand->id])}}">
                                @if($category->img)
                                    <img src="{{ asset($category->img) }}" style="width: 50%;">
                                @endif
                                <span>{{ $category->name }}</span>
                            </a>  
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</x-layouts.app>