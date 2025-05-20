<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;



use App\Interfaces\ProductInterface;
use App\Services\ProductService;

use App\Interfaces\DeliverInterface;
use App\Services\DeliverService;



use App\Interfaces\BrandInterface;
use App\Services\BrandService;

use App\Interfaces\BasketInterface;
use App\Services\BasketService;

use App\Interfaces\WishlistInterface;
use App\Services\WishlistService;

use App\Interfaces\CompareInterface;
use App\Services\CompareService;

use App\Interfaces\MainPageInterface;
use App\Services\MainPageService;


use App\Interfaces\PageInterface;
use App\Services\PageService;

use App\Interfaces\StockInterface;
use App\Services\StockService;

use App\Interfaces\OrderInterface;
use App\Services\OrderService;

use App\Interfaces\FeedbackInterface;
use App\Services\FeedbackService;

use App\Services\SalesdriverService;
use App\Interfaces\SalesdriverInterface;

use App\Interfaces\UserAuthManagerInterface;
use App\Services\UserAuthManagerService;

use App\Interfaces\SeoFilterCategoryInterface;
use App\Services\SeoFilterCategory;


use App\Interfaces\BlogInterface;
use App\Services\BlogService;

use App\Interfaces\CommentPostInterface;
use App\Services\CommentPostService;

use App\Interfaces\PaymentMethodInterface;
use App\Services\PaymentMethodService;

use App\Interfaces\InstallmentsPrivatbankInterface;
use App\Services\InstallmentsPrivatbankService;

use App\Interfaces\TelegramNotificationInterface;
use App\Services\TelegramNotificationService;


use App\Interfaces\PromoCodeInterface;
use App\Services\PromoCodeService;


class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /*$this->app->bind(
            OrderConfirmInterface::class,
            OrderConfirmService::class,

        );*/

        $this->app->bind(
            PromoCodeInterface::class,
            PromoCodeService::class,

        );


        $this->app->bind(
            TelegramNotificationInterface::class,
            TelegramNotificationService::class,

        );


        $this->app->bind(
            InstallmentsPrivatbankInterface::class,
            InstallmentsPrivatbankService::class,

        );

        $this->app->bind(
            PaymentMethodInterface::class,
            PaymentMethodService::class,

        );


        $this->app->bind(
            CommentPostInterface::class,
            CommentPostService::class,

        );


        $this->app->bind(
            BlogInterface::class,
            BlogService::class,

        );
        
        $this->app->bind(
            DeliverInterface::class,
            DeliverService::class,

        );

        $this->app->bind(
            UserAuthManagerInterface::class,
            UserAuthManagerService::class,

        );

        $this->app->bind(
            StockInterface::class,
            StockService::class,

        );

        $this->app->bind(
            OrderInterface::class,
            OrderService::class,

        );
        
        $this->app->bind(
            PageInterface::class,
            PageService::class,

        );

        $this->app->bind(
            MainPageInterface::class,
            MainPageService::class,

        );

        

        $this->app->bind(
            ProductInterface::class,
            ProductService::class,

        );

        $this->app->bind(
            BrandInterface::class,
            BrandService::class,

        );

        $this->app->bind(
            BasketInterface::class,
            BasketService::class,

        );

        $this->app->bind(
            WishlistInterface::class,
            WishlistService::class,

        );

        $this->app->bind(
            CompareInterface::class,
            CompareService::class,

        );

        $this->app->bind(
            FeedbackInterface::class,
            FeedbackService::class,

        );

        $this->app->bind(
            SalesdriverInterface::class,
            SalesdriverService::class,

        );

        $this->app->bind(
            SeoFilterCategoryInterface::class,
            SeoFilterCategory::class,

        );
    }
}
