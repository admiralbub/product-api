
<x-layouts.app  
    :title="$page->meta_title"
    :descriptions="$page->meta_description"
    :keywords="$page->meta_keywords"
    no_index=0>


    <x-banner.main-slider :sliders="$slidersMains" />
    <!--<div class="container pt-3">
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                {{--<x-block.catalog/>--}}
            </div>
            <div class="col-sm-12 col-lg-9">
               Swiper
                {{--<x-banner.main-slider :sliders="$slidersMains" />--}}
            </div>
            
        </div>
                   
    </div>!-->
    <x-block.about :page="$page"/>
    
    {{--<x-block.top-categories/>--}}
 
    <x-block.new-product :newProduct="$newProduct"/>
    <x-block.recommended-product :recommendedProducts="$recommendedProduct"/>
    <x-block.sale-product :saleProducts="$saleProduct"/>
    <x-block.popular-product :popularProducts="$popularProduct"/>

    <x-block.blog :blogMains="$blogMains"/>
   
   
</x-layouts.app>
