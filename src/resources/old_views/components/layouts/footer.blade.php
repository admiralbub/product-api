<footer class="footer py-5 mb-4 mb-lg-0">
    <div class="container">
        <div class="row ">
            <div class="col-xl-5 col-lg-3 col-md-4 col-sm-6 py-3 py-lg-0">
                <div class="footer-logo">
                    <a href="#">
                        <img src="{{settings('logo_site')}}" width="150px">
                    </a>
                        
                </div>
                <div class="footer-description pt-4">
                    <p>
                        {{settings('description_site_'.app()->getLocale())}}
                    </p>
                </div>
                <div class="footer-social pt-4">
                    @if(settings('telegram_site'))
                        <div class="footer-social-item">
                            <a href="{{settings('telegram_site')}}">
                                <span>
                                    <i class="bi bi-telegram"></i>
                                </span>
                            </a>
                        </div>
                    @endif
                    @if(settings('facebook_site'))
                        <div class="footer-social-item">
                            <a href="{{settings('facebook_site')}}">
                                <span>
                                    <i class="bi bi-facebook"></i>
                                </span>
                            </a>
                        </div>
                    @endif
                    @if(settings('youtube_site'))
                        <div class="footer-social-item">
                            <a href="{{settings('youtube_site')}}">
                                <span>
                                    <i class="bi bi-youtube"></i>
                                </span>
                            </a>
                        </div>
                    @endif
                    @if(settings('tiktok_site'))
                        <div class="footer-social-item">
                            <a href="{{settings('tiktok_site')}}">
                                <span>
                                    <i class="bi bi-tiktok"></i>
                                </span>
                            </a>
                        </div>
                    @endif
                    @if(settings('instagram_site'))
                        <div class="footer-social-item">
                            <a href="{{settings('instagram_site')}}">
                                <span>
                                    <i class="bi bi-instagram"></i>

                                </span>
                            </a>
                        </div>
                    @endif
                    @if(settings('viber_site'))
                        <div class="footer-social-item">
                            <a href="{{settings('viber_site')}}">
                                <span>
                                    <img src="{{asset('icon/viber.png')}}" alt="" width="30px">

                                </span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 py-3 py-lg-0">
                <span class="fs-4 footer-heading">{{__('Catalog')}}</span>
                <ul class="footer-links pt-3">
                    <li>
                        <a href="{{route('index')}}">
                            {{__('Home')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{route('product.brand.list')}}">
                            {{__('Brand')}}
                        </a>
                    </li>
                    <!--<li>
                        <a href="#">
                            {{__('Blog')}}
                        </a>
                    </li>!-->
                    <li>
                        <a href="{{route('stock.index')}}">
                            {{__('Stocks')}}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 py-3 py-lg-0">
                <span class="fs-4 footer-heading">{{__('Buyers')}}</span>
                @if(count(pages())>0)
                    <ul class="footer-links pt-3">
                        @foreach(pages() as $page)
                            <li>
                                <a href="{{route('page.pages',['slug'=>$page->url])}}">
                                    {{$page->name}}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{route('faq.index')}}">
                                {{__('Faq')}}
                            </a>
                        </li>     
                        <li><a href="{{route('blog.list')}}">{{__('Blog')}}</a></li>
                    </ul>
                @endif
               
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 py-3 py-lg-0">
                <span class="fs-4 footer-heading">{{__('Contact Us')}}</span>
                <ul class="footer-links pt-3">
                    @if(settings('phone_site'))
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>      
                            <span class="footer-icon_link">
                                <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', settings('phone_site'))}}">{{settings('phone_site')}}</a>
                            </span>
                        </li>
                    @endif
                    @if(settings('email_site'))
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <span class="footer-icon_link">
                                <a href="mailto:{{settings('email_site')}}">
                                    {{settings('email_site')}}
                                </a>
                            </span>
                        </li>
                    @endif
                    @if(settings('adress_site_'.app()->getLocale()))
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                                
                            <span class="footer-icon_link">
                                <a href="{{settings('link_adress_site')}}">
                                    {{settings('adress_site_'.app()->getLocale())}}
                                </a>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
                
        </div>
        <div class="py-4">
            <span>{{settings('copyright_site')}}</span>
        </div>
            
    </div>    
</footer>
