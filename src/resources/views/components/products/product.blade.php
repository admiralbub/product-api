
<div class="col-md-4 mb-4 ">
    <div class="product-card position-relative">
        <div class="product-image" onclick="document.location='{{route('product.view',$product->slug)}}'">
            <a href="{{route('product.view',$product->slug)}}">
                <img src="{{ asset($product->image)}}" alt="Apples">
            </a>
        </div>
        <div class="managment" >
            
            <div class="managment_heart AddWislistList">
                <button class="button_heart_card" data-id="{{$product->id}}" data-auth="{{auth()->check() ? '1' : '0'}}">
                    <i class="bi bi-suit-heart fs-5"></i>

                </button>
            </div>    
        </div>
        <div onclick="document.location='{{route('product.view',$product->slug)}}'" style="cursor:pointer;">
            <div class="product-name">
                <a href="{{route('product.view',$product->slug)}}">
                    {{ \Str::limit($product->name, 20) }}
                </a>
            </div>
            <div class="rating_icon">
                <div class="rating" data-rate-value="{{$product->feedback->avg('rating')}}"></div>
            </div>
        </div>
        <div class="price">
            @if ($product->stocks)
                {{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price_stock) }} {{__("uah")}}
            @else
                {{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price) }} {{__("uah")}}
            @endif     
        </div>
        @if ($product->stocks)
            <div class="oldprice">
                
                <span>{{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price) }} {{__("uah")}}</span>
                
            </div>
        @endif 
        @if($product->status->getStatusAvailableAttribute())
            <button class="buy-button AddBasket" data-id="{{$product->id}}"  data-packid="{{$product->packs->first()->id}}">{{__('Add to cart')}}</button>
        @endif
    </div>
</div>