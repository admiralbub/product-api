<x-layouts.app  
    :title="$product->meta_title_parsed ? $product->meta_title_parsed : $product->meta_title"
    :descriptions="$product->meta_description_parsed ? $product->meta_description_parsed : $product->meta_description"
    :keywords="$product->meta_keywords_parse ? $product->meta_keywords_parsed : $product->meta_keywords"
    :no_index=0>

   
    @push('head')
        <x-schema-org.product :product="$product" :feedbacks="$feedbacks"/>
    @endpush
    <x-block.hero :h1="$product->h1_parsed ? $product->h1_parsed : $product->h1" :breadcrumbs="$breadcrumbs"></x-x-block.hero>
    <div class="container">
        <div class="show-card">
            <div class="row g-0">
                <!-- Product Image Column -->
                <div class="col-md-5">
                    <div class="product-image-container">
                        <img src="{{ asset($product->image)}}" alt="Tomato" class="product-image">

                        
                    </div>
                </div>
                
                <!-- Product Details Column -->
                <div class="col-md-7">
                    <div class="product-details">
                        <!-- Product Title and Price -->
                        <div class="d-flex justify-content-between align-items-start ">
                            <h1 class="product-title d-none">Tomato</h1>
                            @if ($product->stocks)
                                <span class="product-price">{{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price_stock) }} {{__("uah")}}</span>
                            @else
                                <span class="product-price">{{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price) }} {{__("uah")}}</span>
                            @endif  
                           
                        </div>
                        
                        @if ($product->stocks)
                            <div>
                                
                                <span class="product-oldprice">{{ ceil(($product->packs->count() > 0 ? $product->packs->first()->volume : 1)  * $product->price) }} {{__("uah")}}</span>
                                
                            </div>
                        @endif  
                        <div class="rating" data-rate-value=" {{$product->feedback->avg('rating')}}"></div>
                        <!-- Product Reviews -->
                        <div class="product-reviews">
                            {{$product->feedback->count()}} {{__('Reviews')}}
                        </div>
                        <div class="product-status mb-3">
                            <span class="{{$product->status->getStatusAvailableAttribute() ? 'status-stock' : 'status-no'}}">
                                {{$product->status->getDescription()}}
                            
                                    
                            </span>
                         
                        </div>
                        <div class="py-2">
                            <a href="#" class="fw-bolder" data-bs-toggle="modal" data-bs-target="#FoundProduct">{{__('Found this product cheaper')}}</a>

                        </div>
                        <!-- Product Description -->
                        <p class="product-description d-none">
                            Aliquam hendrerit a augue insuscipit. Etiam aliquam massa quis des mauris commodo venenatis ligula commodo leez sed blandit convallis dignissim onec vel pellentesque neque.
                        </p>
                        <div class="row pt-2 pb-3">
                            <div class="col-12 col-lg-3 fs-6 pt-2">
                                <strong>{{__('Pack')}}</strong>
                            </div>
                            <div class="col-12 col-lg-9 pt-2">
                                <select  class="form-select pack_select w-100 w-lg-50" id="pack_{{$product->id}}" aria-label="Default select example" >
                                    @foreach($product->packs as $pack)
                                        <option value="{{ $pack->volume }}" id="{{ $pack->id }}" data-price="{{ $pack->volume * $product->price }}" >{{ $pack->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row pt-2 pb-3">
                            <div class="col-12 col-lg-3 fs-6 pt-2">
                                <strong>{{__('Brand')}}</strong>
                            </div>
                            <div class="col-12 col-lg-9 pt-2">
                                <a href="{{route('product.brand.show',['slug'=>$product->brand->slug])}}">{{$product->brand->name}}</a>
                            </div>
                        </div>
                        @if($attrs->count())
                            @foreach($attrs as $groupName => $attributes)
                                <div class="row pt-2 pb-3">
                                    <div class="col-12 col-lg-3 fs-6 pt-2">
                                        <strong>{{$groupName}}</strong>
                                    </div>
                                    <div class="col-12 col-lg-9 pt-2">
                                        @foreach ($attributes as $attr) 
                                            {{ $attr->name }}
                                            @if(!$loop->last) | @endif
                                        @endforeach
                                    </div>
                                </div>            
                            @endforeach
                        @endif
                        <!-- Quantity Selector -->
                        <div class="d-flex">
                            <div class="quantity-selector d-flex align-items-center">
                                <strong class="quantity-label">{{__('Quantity')}}</strong>
                                <div class="quantity-controls">
                                    <input type="number" class="quantity-controls__display" value="1" min="1" width="30%" name="quantity" id="qty">
                                    <div class="quantity-controls__controls">
                                        <button class="increment">+</button>
                                        <button class="decrement">−</button>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="py-1 px-4 pb-3">
                                <button class="btn border" id="AddWislistShow" data-id="{{$product->id}}" data-auth="{{auth()->check() ? '1' : '0'}}">
                                    <i class="bi bi-suit-heart fs-3"></i>            
                                </button>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        @if($product->status->getStatusAvailableAttribute())
                            <div class="action-buttons">
                                
                                <button class="btn btn-primary px-4 py-2" data-id="{{$product->id}}" data-packid="{{$product->packs->first()->id}}" id="AddBasketView">{{__('Add to cart')}}</button>
                                <button class="add-to-wishlist px-4 py-2" data-bs-toggle="modal" data-bs-target="#onclick">{{__('Buy in 1 click')}}</button>
                            </div>
                        @endif
                        
                        <x-one-click.form :product="$product"></x-one-click.form>
                        <div class="social-share">
                            <!-- Social Share -->
                            <div class="social-icons">
                                @if(settings('telegram_site'))
                                    <a href="{{settings('telegram_site')}}"><i class="bi bi-telegram"></i></a>
                                @endif
                                @if(settings('facebook_site'))
                                    <a href="{{settings('facebook_site')}}"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if(settings('youtube_site'))
                                    <a href="{{settings('youtube_site')}}"><i class="bi bi-youtube"></i></a>
                                @endif
                                @if(settings('tiktok_site'))
                                    <a href="{{settings('tiktok_site')}}"><i class="bi bi-tiktok"></i></a>
                                @endif
                                @if(settings('instagram_site'))
                                    <a href="{{settings('instagram_site')}}"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if(settings('viber_site'))
                                    
                                    <a href="{{settings('viber_site')}}"><img src="{{asset('images/icon/icons8-viber-100.png')}}" class="viber-icon" alt="" width="20px"></a>

                                    
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="mt-4">
                    @auth
                    
                        @if(!empty(auth()->user()->permissions))
                            <a href="/admin/products/{{$product->id}}/edit" target="_blank" class="primary">
                                <i class="bi bi-pencil-fill"></i>

                                <span>{{__('Edit')}}</span>
                            </a>
                        @endif
                    @endif
                </div>
                <div class="mt-4">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{__('description_two')}}
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body description_product">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    {{__('Deliver')}}
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!!settings('about_deliver_'.app()->getLocale())!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">  
                    <div class="reviews-tab mt-2">
                        <div class="row g-3 mt-4">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="reviews-tab-bb">
                                    <h4>{{__('Feedbacks')}}</h4>    
                    
                                    <div class="reviews-lists mt-4">
                                        @if(count($feedbacks)>0)
                                            @foreach($feedbacks as $feedback)
                                                <x-feedbacks.feedback-list :feedback="$feedback"/>
                                            @endforeach
                                        @else
                                            <p>{{__('There are no reviews for this product at this time')}}</p>
                                        @endif
                                    </div>  
                                </div>
                            </div>
                    
                            <div class="col-12 col-lg-12 col-md-12">
                                <x-feedbacks.form :id="$product->id" :slug="$product->slug"></x-feedbacks.form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-found-cheaper :product="$product"/>
</x-layouts.app>