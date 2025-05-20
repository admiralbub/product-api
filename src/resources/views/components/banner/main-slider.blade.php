@if(count($sliders)>0)    
    <div class="container">
        <div class="unit_swiper_advantages">
            <div class="swiper main_banner">
                <div class="swiper-wrapper main_banner-wrapper">
                    @foreach ($sliders as $slider)
                        <div class="main_banner-wrapper-slide swiper-slide">

                            @if($slider->url)
                                <a href="{{$slider->url}}">
                                    <img src="{{ asset($slider->img) }}">
                                </a>
                            @else
                                <img src="{{ asset($slider->img) }}">
                            @endif
                        </div>
                    @endforeach
                    

                </div>
                
                <!-- Стрелки -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                
                <!-- Пагинация -->
                <div class="swiper-pagination"></div>
            </div>
            <x-block.advantages/>
        </div>
        
    </div>
@endif


