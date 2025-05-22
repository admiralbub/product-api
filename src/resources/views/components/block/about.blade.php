@props([
    'page',
])
<div class="about_block pt-3">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="about_block-img">
                    <img src="{{asset('images/elements.png')}}" alt="">
                </div>
                 
            </div>
            <div class="col-12 col-lg-7 about_block-text">
                <h1>{{$page->h1}}</h1>
                <p>{!!$page->description!!}</p>
                    
            </div>
        </div>
    </div>
</div>
