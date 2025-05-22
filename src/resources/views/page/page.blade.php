<x-layouts.app  
    :title="$page->meta_title"
    :descriptions="$page->meta_description"
    :keywords="$page->meta_keywords"
    no_index=0>
    <x-block.hero :h1="$page->h1" :breadcrumbs="$breadcrumbs"></x-x-block.hero>
    <div class="container py-2 ">
        
        
        <div class="row mt-4 mb-4 ">
            <div class="@if($page->img) col-12 col-lg-8 @endif page_description">
                {!! preg_replace('#<h1([^>]*)>(.*)</h1>#m','<h2$1>$2</h2>', $page->description) !!}
            </div>
            <div class="col-12 col-lg-4">
                <img src="{{asset($page->img)}}" alt="" class="w-100">
            </div>
        </div>
        @if(count($page->products)>0)
            <div class="mt-4">
                <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-sm-2 row-cols-2 mb-30 card_products">
                    @foreach($page->products as $product)
                        <x-products.product :product="$product"></x-products.product>
                    @endforeach
                </div>
            </div>
            
        @endif
        @if($page->url == 'kontakti')
            <div class="mb-4">
                <div class="row g-0">
                    <!-- Map Column (Left Side) -->
                    <div class="col-12 col-md-5 d-none d-md-block">
                        <div class="map-container">
                            <!-- This would be where the map goes - using a placeholder for now -->
                            {!! settings('code_google_maps') !!}
                        </div>
                    </div>
                    
                    <!-- Contact Form Column (Right Side) -->
                    <div class="col-12 col-md-7">
                        <div class="contact-section p-4 p-md-5">
                            <div class="contact-section__header">{{__('Contacts')}}</div>
                            <h3 class="contact-section__title">{{__('Contact Us')}}</h3>
                            
                            <form class="contact-section__form form" method="POST" action="{{route('page.contact_send')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="{{__('full name')}}" data-require="true" name="full_name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" placeholder="Email" data-require="true" name="email">
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" placeholder="{{__('Comment')}}" name="comment"></textarea>
                                    </div>
                                    <div class="col-12  mt-3">
                                        <button type="submit" class="btn btn-submit">{{__('Send')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        
    </div>
    
</x-layouts.app>