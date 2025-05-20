@props([
    'page',
])
<div class="container">
    <div class="about_block">
        <div class="row">
            <div class="col-12 col-lg-6 about_block-img">
                <img src="{{asset('images/elements.png')}}" alt="">
            </div>
            <div class="col-12 col-lg-6 about_block-text">
                <h1>{{$page->h1}}</h1>
                <p>{!!$page->description!!}</p>
                
            </div>
        </div>
    </div>
</div>