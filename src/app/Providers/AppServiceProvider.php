<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
/*use App\Interfaces\CategoryInterface;
use App\Services\CategoryService;*/



use App\Models\Setting;
use App\Models\PaymentProvider;

use App\Models\Page;
use App\Models\SeoTemplate;
use App\Enums\TypeSeoTemplate;

use App\Models\MarketingService;
use Illuminate\Pagination\Paginator;
use Orchid\Support\Facades\Dashboard;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      
        Paginator::useBootstrap();
        Dashboard::useModel(
            \Orchid\Platform\Models\User::class,
            \App\Models\User::class
        );

        $this->app->singleton('settings', function () {
            return Setting::all()->pluck('value', 'key');
        });

        $this->app->singleton('payment_providers', function () {
            return PaymentProvider::all()->pluck('value', 'key');
        });



        $this->app->singleton('seo_product', function () {
            return SeoTemplate::where('type', TypeSeoTemplate::PRODUCT)
                ->available();
        });

        $this->app->singleton('seo_blog', function () {
            return SeoTemplate::where('type', TypeSeoTemplate::BLOG)
                ->available();
        });

        $this->app->singleton('seo_stock', function () {
            return SeoTemplate::where('type', TypeSeoTemplate::STOCK)
                ->available();
        });

        $this->app->singleton('seo_brand', function () {
            return SeoTemplate::where('type', TypeSeoTemplate::BRAND)
                ->available();
        });
        $this->app->singleton('seo_category', function () {
            return SeoTemplate::where('type', TypeSeoTemplate::CATEGORY)
                ->available();
        });
        


        

        $this->app->singleton('pages', function () {
            return Page::available()->visible()->get();
        });
        $this->app->singleton('marketing_service_head', function () {
            return MarketingService::available()->head()->get();
        });
        $this->app->singleton('marketing_service_body', function () {
            return MarketingService::available()->body()->get();
        });
        $this->app->singleton('marketing_service_body_close', function () {
            return MarketingService::available()->bodyClose()->get();
        });
        
        
    }


}
