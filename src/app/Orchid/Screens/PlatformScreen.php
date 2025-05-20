<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Post;
class PlatformScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('Dashboard');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return '';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        $count_order = Order::query()->count();
        $user_count = User::query()->count();
        $product_count = Product::available()->count();
        $brand_count = Brand::published()->count();
        $blog_count = Post::available()->count();
        $pay_count = Order::where('status','paid')->count();
        return [
            //Layout::view('platform::partials.update-assets'),
            //Layout::view('platform::partials.welcome'),
            Layout::view('admin.dashboard',[
                'count_order'=>$count_order,
                'user_count'=>$user_count,
                'product_count'=>$product_count,
                'brand_count'=>$brand_count,
                'blog_count'=>$blog_count,
                'pay_count'=>$pay_count
            ]),
        ];
    }
}
