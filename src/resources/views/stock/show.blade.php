<x-layouts.app  
    :title="$stock->meta_title_parsed ? $stock->meta_title_parsed : $stock->meta_title"
    :descriptions="$stock->meta_description_parsed ? $stock->meta_description_parsed : $stock->meta_description"
    :keywords="$stock->meta_keywords_parse ? $stock->meta_keywords_parsed : $stock->meta_keywords"
    :no_index=0>
    <x-block.hero :h1="$stock->h1_parsed ? $stock->h1_parsed : $stock->h1" :breadcrumbs="$breadcrumbs"></x-x-block.hero>
    
    <div class="container mb-5 mt-5">
        <!-- Hero Image Section -->
        <div class="hero-section mb-4">
            <img src="{{asset($stock->img)}}" alt="Farmer working in rice field" class="img-fluid">
        </div>
        <div class="row">
            <div class="col-lg-8">
                
                
                <!-- Main Content Section -->
                <div class="main-content">
                    {!! $stock->body !!}
                    
                </div>
            </div>
            
            <!-- Sidebar Information Card -->
            <div class="col-lg-4">
                <div class="info-card">
                    <div class="service-info">
                        <div class="section-content">
                            <i class="bi bi-calendar"></i>
                            <span class="px-1">
                                {{dateBetween($stock->start_stocks_date, $stock->end_stocks_date, $lang)}}
                            </span>
                            
                        </div>
                    </div>
                    
                    
                    <div class="farmer-info">
                        <div class="section-title">
                            <i class="bi bi-clock me-1"></i>
                            @if(lastDay($stock->start_stocks_date, $stock->end_stocks_date) > 0)
                                {{ __("left_time") }} {{ lastDay($stock->start_stocks_date, $stock->end_stocks_date) }} {{ __("days_stock") }}
                            @elseif(lastDay($stock->start_stocks_date, $stock->end_stocks_date) === 0)
                                {{ __("left_time") }} {{ lastDay($stock->start_stocks_date, $stock->end_stocks_date)->diffInHours($end_date, false) }} {{ __("hours_title") }}
                            @else
                                {{ __("expired_title") }} <!-- Например, "Акция завершена" -->
                            @endif
                        </div>
                        <div class="section-content"></div>
                    </div>
                    
                    
                   
                  
                </div>
            </div>
        </div>
      

       
        <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-sm-2 row-cols-2 mb-30 card_products mt-5">
            @foreach($products as $product)
                <x-products.product :product="$product"></x-products.product>
            @endforeach
        </div>
        {!! $products->links() !!}

    </div>
</x-layouts.app>