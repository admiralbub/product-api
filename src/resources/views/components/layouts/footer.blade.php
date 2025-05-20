 <!-- Footer -->
 <footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <img src="{{settings('logo_footer')}}" alt="" class="footer-logo">
                <p class="footer-description">{{settings('description_site_'.app()->getLocale())}}</p>
                <div class="social-icons">
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
                        <a href="{{settings('viber_site')}}"><img src="{{asset('icon/viber.png')}}" alt="" width="30px"></a>
                    @endif
                </div>
            </div>
                
            <!-- Explore Links -->
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h5>{{__('Catalog')}}</h5>
                <ul class="footer-links">
                    <li><a href="{{route('index')}}"><i class="bi bi-chevron-right"></i>  {{__('Home')}}</a></li>
                    <li><a href="{{route('product.brand.list')}}"><i class="bi bi-chevron-right"></i> {{__('Brand')}}</a></li>
                    <li><a href="{{route('stock.index')}}"><i class="bi bi-chevron-right"></i> {{__('Stocks')}}</a></li>
                </ul>
            </div>
                
            <!-- News Articles -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5>{{__('Buyers')}}</h5>
                <ul class="footer-links">
                    @if(count(pages())>0)
                        @foreach(pages() as $page)
                            <li><a href="{{route('page.pages',['slug'=>$page->url])}}"><i class="bi bi-chevron-right"></i>  {{$page->name}}</a></li>
                        @endforeach
                     @endif
                    <li><a href="{{route('faq.index')}}"><i class="bi bi-chevron-right"></i> {{__('Faq')}}</a></li>
                    <li><a href="{{route('blog.list')}}"><i class="bi bi-chevron-right"></i> {{__('Blog')}}</a></li>
                </ul>
            </div>
                
            <!-- Contact Information -->
            <div class="col-lg-3 col-md-6">
                <h5>{{__('Contact Us')}}</h5>
                @if(settings('phone_site'))
                    <div class="contact-info">
                        <i class="bi bi-telephone-fill"></i>
                        <div>
                            <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', settings('phone_site'))}}">{{settings('phone_site')}}</a>
                        </div>
                    </div>
                @endif
                @if(settings('email_site'))
                    <div class="contact-info">
                        <i class="bi bi-envelope-fill"></i>
                        <div>
                            <a href="mailto:{{settings('email_site')}}">
                                {{settings('email_site')}}
                            </a>
                        </div>
                    </div>
                @endif
                <div class="contact-info">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div>
                        <p class="mb-0">
                            <a href="{{settings('link_adress_site')}}">
                                {{settings('adress_site_'.app()->getLocale())}}
                            </a>
                        </p>
                    </div>
                </div>
                    
                <!-- Newsletter -->
                <div class="newsletter-form d-none">
                    <input type="email" placeholder="Your Email Address">
                    <button type="submit"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
            
           
    </div>
        
    <!-- Footer Bottom -->
    <div class=" footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="copyright">{{settings('copyright_site')}}</p>
                </div>
                <div class="col-md-6 footer-bottom-links d-none">
                    <a href="#">Terms of Use</a>
                    <a href="#">Privacy Policy</a>
                </div>
            </div>
        </div>
           
    </div>
</footer>