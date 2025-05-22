
<div class="top-nav">
    <div class="container">
        <div class="d-flex  justify-content-between">
            <div class="top-nav-left">
                {{settings('text_left_site_'.app()->getLocale())}}
            </div>
            
            <div class="top-nav-right">
                
                <ul class="top-nav-right-list d-lg-flex d-none">
                    @auth
              
                        @if(!empty(auth()->user()->permissions))
                            <li>
                                <a href="/admin" target="_blank" >{{__('Admin panel')}}</a>
                            </li>
                        @endif
                    @endif
                    <li class="dropdown">
                         <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                           
                            <span class="text-uppercase">{{ LaravelLocalization::getCurrentLocale()}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                                  
                        </a>
                        <ul class="dropdown-menu">
                            
                            <li>
                               
                                <a rel="alternate" href="{{ LaravelLocalization::getLocalizedURL('ua', null, [], true) }}"
                                    class="dropdown-item">
                                    <span>Українська</span>
                                </a>
                            </li>
                            <li>
                                <a rel="alternate" href="{{ LaravelLocalization::getLocalizedURL('ru', null, [], true) }}"
                                    class="dropdown-item">
                                    <span>Русский</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li >
                        @guest
                            <a href="{{route('auth.enter')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <span>
                                    {{__('Enter')}}
                                </span>
                                
                            </a>
                        @else   
                            <a href="#"  data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <span>
                                    {{__('Profil')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{route('profile')}}">
                                        
                                        <span>{{__('Account')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('auth.signout')}}">
                                        
                                        <span>{{__('Sign out')}}</span>
                                    </a>
                                </li>
                            </ul>
                        @endauth 
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<header class="top-header pt-2 mt-3">

    <div class="container mb-3 header-mob-fixed">
        <div class="row d-flex  align-items-center ">
            <!-- Logo -->
            <div class="col-md  d-flex align-items-center justify-content-between">
               
                <a href="{{route('index')}}">
                    <img src="{{settings('logo_site')}}" width="150px" class="img-fluid logo">
                </a>
                <div class="col-md d-flex justify-content-end d-lg-none  open-mob-menu px-lg-0">
                    <i class="bi bi-list" style="font-size: 28px;"></i>
                </div>
            </div>

            <!-- Mobile toggle -->
            

            <!-- Social + contact (desktop only) -->
            <div class="col-md d-none d-xxl-flex justify-content-around top-header-social_icon">
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
                    <a href="{{settings('viber_site')}}"><img src="{{asset('images/icon/icons8-viber-100.png')}}" alt="" width="20px"></a>
                @endif
            </div>

            <div class="col-md d-none d-lg-flex align-items-center contact-box">
                <div class="contact-info">
                    <img src="{{asset('images/icon/phone.svg')}}" alt="">
                    <div>
                        <small>{{__('Phone_title')}}</small>
                        <strong class="text-nowrap">
                            <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', settings('phone_site'))}}">{{settings('phone_site')}}</a>
                        </strong>
                    </div>
                </div>
            </div>

            <div class="col-md d-none d-lg-block contact-box">
                <div class="contact-info">
                    <img src="{{asset('images/icon/email-icon.svg')}}" alt="">
                    <div>
                        <small>{{__('Email')}}</small>
                        <strong>
                            <a href="mailto:{{settings('email_site')}}">
                                {{settings('email_site')}}
                            </a>
                        </strong>
                    </div>
                </div>
            </div>

            <div class="col-md  d-none d-lg-block contact-box ">
                <div class="contact-info">
                    <img src="{{asset('images/icon/map.png')}}" alt="" class="px-1">
                    <div>
                        <small>{{__('Address')}}</small>
                        <strong class="text-nowrap"><a href="{{settings('link_adress_site')}}">{{settings('header_contact_'.app()->getLocale())}}</a></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <div class="navbar-menu d-none d-lg-block">
        <div class="torn-paper-top"></div>
        <div class="navbar-menu-fixed">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 d-flex justify-content-between align-items-center flex-wrap">

                        <!-- Collapsible menu for mobile -->
                        <div class="collapse d-md-flex flex-grow-1" id="mobileMenu">
                            <nav class="nav-links flex-column flex-md-row">
                                <li><a class="dropdown-item" href="{{route('index')}}">{{__('Home')}}</a></li>
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link d-flex align-items-center gap-2 nav_menu_catalogs">
                                        <span>{{__('Catalog')}}</span><i class="bi bi-chevron-down"></i>
                                    </a>
                                    <ul class="dropdown-menu nav_menu_catalogs__products">
                                        <li class="dropdown-submenu d-none">
                                            <a class="dropdown-item" href="#">
                                                Категория 1
                                                <i class="bi bi-chevron-right float-end"></i>
                                            </a>
                                            <div class="submenu dropdown-menu">
                                                <ul class="top-navigation">
                                                    <li><a class="dropdown-item" href="#">Подкатегория 1.1</a></li>
                                                    <li><a class="dropdown-item" href="#">Подкатегория 1.2</a></li>
                                                    <li><a class="dropdown-item" href="#">Подкатегория 1.3</a></li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="dropdown-submenu d-none">
                                            <a class="dropdown-item" href="#">
                                                Категория 2
                                                <i class="bi bi-chevron-right float-end d-none"></i>
                                            </a>
                                            <div class="submenu dropdown-menu d-none">
                                                <ul class="top-navigation">
                                                    <li>
                                                        <a class="dropdown-item" href="#">Подкатегория 2.1</a>
                                                        <ul class="top-navigation-list">
                                                            <li><a href="https://zelenijmajster.com/ru/products/gerbicidi-vibirkovoji-diji">Гербициды выборочного действия</a></li>
                                                            <li><a href="https://zelenijmajster.com/ru/products/gruntovi-gerbicidi">Грунтовые гербициды</a></li>
                                                            <li><a href="https://zelenijmajster.com/ru/products/pislyashodovi-gerbicidi">Послевсходовые гербициды</a></li>
                                                            <li><a href="https://zelenijmajster.com/ru/products/desikanti">Десиканты</a></li>
                                                        </ul>
                                                    </li>

                                                
                                                
                                                </ul>
                                            </div>
                                        </li>
                                        <x-layouts.catalog/>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="{{route('stock.index')}}">{{__('Stocks')}}</a></li>
                                <li><a class="dropdown-item" href="{{route('product.brand.list')}}">{{__('Brand')}}</a></li>
                                <li><a class="dropdown-item" href="{{route('blog.list')}}">{{__('Blog')}}</a></li>
                                <li><a class="dropdown-item" href="{{route('faq.index')}}"> Faq</a></li>   
                                @if(count(pages())>0)
                                    @foreach(pages() as $page)
                                        <li>
                                            <a class="dropdown-item" href="{{route('page.pages',['slug'=>$page->url])}}">
                                                {{$page->name}}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </nav>
                        </div>
                        <div class="icons-search d-flex align-items-center  mt-3 mt-md-0">
                            <i class="bi bi-search me-3 fs-5" data-bs-toggle="modal" data-bs-target="#searchModal"></i>
                        </div>
                        <!-- Icons (always visible) -->
                        <div class="icons d-flex align-items-center border-left mt-3 mt-md-0">
                            
                            
                            <div class="position-relative me-4">
                                <a href="{{route('profile.wislist')}}">
                                    <i class="bi bi-suit-heart fs-5"></i>
            
                                    <span class="cart-count @auth countWislist @endif" data-bb-value="compare-count">0</span>
                                </a>
                            </div>
                            <div class="position-relative" id="openRightBasket">
                                <i class="bi bi-cart"></i>
                                <span class="cart-count" id="basket-count">0</span>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</header>
