@if(settings('banner_between_main'))
    <div class="container-fuild p-0">
        <div class="agriculture-banner">
            <a href="{{settings('link_banner_between_main')}}">
                <img src="{{settings('banner_between_main')}}" alt="">
            </a>
        </div>
    </div>
@endif