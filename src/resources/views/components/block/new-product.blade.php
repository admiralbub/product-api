@if(count($newProduct)>0)
    <div class="main-products py-3">
        <div class="container mb-3">
            <div class="d-flex justify-content-between">
                <div class="main-products_heading">
                    <h3 class="fs-1 ">
                        {!! __('New products') !!}
                
                    </h3>
                </div>
                <div class="main-products_link d-none">
                    <a href="#">
                        {{__('All product')}}
                    </a>
                </div>
            </div>
            <div class="swiper card_products card_products_main mt-3">
                <div class=" swiper-wrapper">
                    @foreach($newProduct as $product)
                        <x-products.slider-product :product="$product"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
@endif