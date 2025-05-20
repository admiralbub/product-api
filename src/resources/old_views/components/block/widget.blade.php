<div class="to-top">
    @if(settings('telegram_bot_site'))
        <div class="to-top-telegram ">
            <a href="{{settings('telegram_bot_site')}}">
                <img src="{{asset('icon/telegram_iconpic.webp')}}" alt="">
            </a>
            
        </div>
    @endif
    @if(settings('viber_bot_site'))
        <div class="to-top-viber ">
            <a href="{{settings('viber_bot_site')}}">
                <img src="{{asset('icon/viberbig.png')}}" alt="">
            </a>
            
        </div>
    @endif
</div>