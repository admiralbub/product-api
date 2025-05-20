@props(['title','descriptions','keywords','no_index'])
<!DOCTYPE html>
@if(app()->getLocale() == "ua")
<html lang="uk">
@elseif (app()->getLocale() == "ru")
<html lang="ru">
@endif
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="client-ip"  content="{{ request()->getClientIp() }}">
        <title>{{$title ?? ""}}</title>
        <meta property="og:title" content="{{$title}}">
        <meta property="og:description" content="{{$descriptions ?? ''}}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

      
        <meta name="description" content="{{$descriptions ?? ''}}">
        <meta name="keywords" content="{{$keywords ?? ''}}">

        @if($no_index || request()->has('page') || request()->has('sort') || request()->has('min_price') || request()->has('max_price'))
            <meta name="robots" content="noindex, nofollow">
        @endif
        @php
            $url_basic = 'https://'.$_SERVER['HTTP_HOST'] . '' . $_SERVER['REQUEST_URI'];
            if (str_contains($url_basic, '&page')) {
                $url_basic = strstr($url_basic, '&page', true);
            }
            $url_basic = urldecode($url_basic);
            $position = strpos($url_basic, '?');
            if ($position !== false) {
                $url_basic = substr($url_basic, 0, $position);
            }
        @endphp
        @if(!request()->has('page'))    
            <link rel="canonical" href="{{ mb_strtolower($url_basic) }}" />
        @endif
        <link rel="alternate" hreflang="ru-UA" href="{{ strpos(request()->url(), '/ru') === false ? str_replace(config('app.url'), config('app.url').'/ru', request()->url()) : request()->url() }}" />

        <link rel="alternate" hreflang="uk-UA" href="{{str_replace('/ru', '', request()->url())}}" />
        <link rel="alternate" hreflang="x-default" href="{{str_replace('/ru', '', request()->url())}}" />
        <link rel="preconnect" href="{{config('app.url')}}" />
        <link rel="dns-prefetch" href="{{config('app.url')}}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="{{settings('favicon')}}">
       
  
        @vite('resources/scss/app.scss')
        @vite('resources/js/app.js')
        @stack('head')

        @if(marketing_service_head()) 
            @foreach(marketing_service_head() as $ss)
                {!! $ss->script !!}
            @endforeach
        @endif

    </head>
    
    <body>
        @if(marketing_service_body()) 
            @foreach(marketing_service_body() as $ss)
                {!! $ss->script !!}
            @endforeach
        @endif

        <x-alert.toast/>
        <x-layouts.header/>
        <x-layouts.header-mob/>
        <x-layouts.catalog/>
        <div class="main mt-2 mt-md-1">
            {{ $slot }}
        </div>
        {{-- <x-block.subscribers/>--}}
        <x-layouts.footer/>
        <x-layouts.mob_nav_bottom/>
        <x-basket/>
        <x-search-mob/>
        <x-block.widget/>
        <div class="body-overlay"></div>
        @if(marketing_service_body_close()) 
            @foreach(marketing_service_body_close() as $ss)
                {!! $ss->script !!}
            @endforeach
        @endif
    </body>
</html>