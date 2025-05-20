<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make(__('Dashboard'))
                ->icon('bs.graph-up')
                ->route('platform.main')
                ->permission('platform.systems.users'),
            Menu::make(__('Turn around to the store'))->icon('bs.layers')->url('/'),
            

            Menu::make(__('Order'))
                ->icon('bs.currency-exchange')
                ->route('platform.order.list')
                ->permission('platform.systems.users'),  
            Menu::make(__('FOUND CHEAPER'))
                ->icon('bs.search')
                ->route('platform.found_cheapers.list')
                ->permission('platform.systems.users'),  
            
            Menu::make(__('Basket'))
                ->icon('bs.basket')
                ->route('platform.baskets.list')
                ->permission('platform.systems.users'),  
                
            Menu::make(__('Promocodes'))
                ->icon('bs.star-fill')
                ->route('platform.promocodes.list')
                ->permission('platform.systems.users'), 
            Menu::make(__('Products'))
                ->icon('bs.cart')
                ->list([
                    
                    Menu::make(__('Goods'))->route('platform.products.list'),
                    Menu::make(__('Brand'))->route('platform.brands.list'),
                    Menu::make(__('Pack'))->route('platform.packs.list'),
                    Menu::make(__('Catogories'))->route('platform.catogories.list'),
                    Menu::make(__('Stocks'))->route('platform.stock.list'),
                    Menu::make(__('Attribute'))->route('platform.attr.list'),
                  //  Menu::make(__('Price variation'))->route('platform.prices.list'),
                ]),
            Menu::make(__('SEO'))
                ->icon('bs.bar-chart-steps')
                ->list([
                    Menu::make(__('Seo filter'))->route('platform.seo-filters.list'),
                    Menu::make(__('Seo template'))->route('platform.seo-templates.list'),
                    Menu::make(__('Marketing services'))->route('platform.marketing-services.list'),
                ]),
            Menu::make(__('Reviews and comments'))
                ->icon('bi.chat-fill')
                ->list([
                    
                    Menu::make(__('Feedbacks'))->route('platform.feedback.list'),
                    Menu::make(__('Comments under the blog'))->route('platform.blog_comments.list'),
                  //  Menu::make(__('Price variation'))->route('platform.prices.list'),
                ]), 
            Menu::make(__('Setting'))
                ->icon('bi.tools')
                ->list([
                    Menu::make(__('Setting'))->route('platform.setting.list'),
                    Menu::make(__('Deliver'))->route('platform.delivers.list'),
                    Menu::make(__('Payment options'))->route('platform.pay_methods.list'),
                    Menu::make(__('Payment systems'))->route('platform.payment_providers.list'),
                ]),

            Menu::make(__('Blog'))
                ->icon('bi.book')
                ->list([
                    Menu::make(__('Blog'))->route('platform.posts.list'),
                    Menu::make(__('Author blog'))->route('platform.author_blogs.list'),
                    //Menu::make(__('Deliver'))->route('platform.delivers.list'),
                ]),
            Menu::make(__('FAQ'))
                ->icon('bi.patch-question-fill')
                ->route('platform.faqs.list')
                ->permission('platform.systems.users'),   
            
           
            Menu::make(__('Pages'))
                ->icon('bs.files')
                ->route('platform.page.list')
                ->permission('platform.systems.users'),        
            Menu::make(__('Sliders'))
                ->icon('bs.card-image')
                ->route('platform.mainslider.list')
                ->permission('platform.systems.users'),        
            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users'),
                
            Menu::make(__('Ban users'))
                ->icon('bs.ban')
                ->route('platform.ban_users.list')
                ->permission('platform.systems.users')
                ->divider(),    
            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),

           
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
