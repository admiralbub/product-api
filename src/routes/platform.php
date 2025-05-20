<?php

declare(strict_types=1);


use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Orchid\Screens\Brand\BrandScreen;
use App\Orchid\Screens\Brand\BrandEditScreen;

use App\Orchid\Screens\Category\CategoryListScreen;
use App\Orchid\Screens\Category\CategoryEditScreen;

use App\Orchid\Screens\Price\PriceListScreen;
use App\Orchid\Screens\Price\PriceEditScreen;

use App\Orchid\Screens\Product\ProductListScreen;
use App\Orchid\Screens\Product\ProductEditScreen;

use App\Orchid\Screens\Pack\PackListScreen;
use App\Orchid\Screens\Pack\PackEditScreen;

///use App\Orchid\Screens\AttrGroup\AttrGroupListScreen;
//use App\Orchid\Screens\AttrGroup\AttrGroupEditScreen;

use App\Orchid\Screens\Attr\AttrListScreen;
use App\Orchid\Screens\Attr\AttrEditScreen;

use App\Orchid\Screens\MainSlider\MainSliderEditScreen;
use App\Orchid\Screens\MainSlider\MainSliderListScreen;

use App\Orchid\Screens\Page\PageEditScreen;
use App\Orchid\Screens\Page\PageListScreen;

use App\Orchid\Screens\Order\OrderEditScreen;
use App\Orchid\Screens\Order\OrderListScreen;

use App\Orchid\Screens\Stock\StockEditScreen;
use App\Orchid\Screens\Stock\StockListScreen;

use App\Orchid\Screens\Setting\SettingScreen;

use App\Orchid\Screens\PaymentProvider\PaymentProviderScreen;


use App\Orchid\Screens\Feedback\FeedbackEditScreen;
use App\Orchid\Screens\Feedback\FeedbackListScreen;

use App\Orchid\Screens\SeoFilter\SeoFilterEditScreen;
use App\Orchid\Screens\SeoFilter\SeoFilterListScreen;

use App\Orchid\Screens\SeoTemplate\SeoTemplateEditScreen;
use App\Orchid\Screens\SeoTemplate\SeoTemplateListScreen;

//use App\Orchid\Screens\SeoProduct\SeoProductScreen;


use App\Orchid\Screens\Faq\FaqEditScreen;
use App\Orchid\Screens\Faq\FaqListScreen;

use App\Orchid\Screens\MarketingService\MarketingServiceListScreen;
use App\Orchid\Screens\MarketingService\MarketingServiceEditScreen;

use App\Orchid\Screens\Deliver\DeliverEditScreen;
use App\Orchid\Screens\Deliver\DeliverListScreen;

use App\Orchid\Screens\Post\PostEditScreen;
use App\Orchid\Screens\Post\PostListScreen;

use App\Orchid\Screens\AuthorPost\AuthorPostEditScreen;
use App\Orchid\Screens\AuthorPost\AuthorPostListScreen;

use App\Orchid\Screens\BlogComment\BlogCommentEditScreen;
use App\Orchid\Screens\BlogComment\BlogCommentListScreen;

use App\Orchid\Screens\PaymentMethod\PaymentMethodEditScreen;
use App\Orchid\Screens\PaymentMethod\PaymentMethodListScreen;

use App\Orchid\Screens\Promocode\PromocodeEditScreen;
use App\Orchid\Screens\Promocode\PromocodeListScreen;

use App\Orchid\Screens\Basket\BasketListScreen;
use App\Orchid\Screens\Basket\BasketEditScreen;

use App\Orchid\Screens\FoundCheaper\FoundCheaperEditScreen;
use App\Orchid\Screens\FoundCheaper\FoundCheaperListScreen;

use App\Orchid\Screens\BanUser\BanUserEditScreen;
use App\Orchid\Screens\BanUser\BanUserListScreen;


Route::screen('/ban_users', BanUserListScreen::class)
    ->name('platform.ban_users.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Ban users'), route('platform.ban_users.list')));

Route::screen('/ban_users/{ban_user}/edit', BanUserEditScreen::class)
    ->name('platform.ban_user.edit')
    ->breadcrumbs(fn (Trail $trail, $ban_user) => $trail
        ->parent('platform.ban_users.list')
        ->push(__('Edit').' №'.$ban_user->id, route('platform.ban_user.edit',$ban_user)));


Route::screen('/ban_users/create', BanUserEditScreen::class)
    ->name('platform.ban_user.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.ban_users.list')
        ->push(__('Create').' '.__('Ban users'), route('platform.ban_user.create')));




        

Route::screen('/foundCheapers', FoundCheaperListScreen::class)
    ->name('platform.found_cheapers.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('FOUND CHEAPER'), route('platform.found_cheapers.list')));
        
Route::screen('/foundCheapers/{foundcheaper}/edit', FoundCheaperEditScreen::class)
     ->name('platform.found_cheaper.edit')
    ->breadcrumbs(fn (Trail $trail, $foundcheaper) => $trail
        ->parent('platform.found_cheapers.list')
        ->push(__('FOUND CHEAPER').' #'.$foundcheaper->id, route('platform.found_cheaper.edit', $foundcheaper)));



Route::screen('/baskets', BasketListScreen::class)
    ->name('platform.baskets.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Basket'), route('platform.baskets.list')));

Route::screen('/baskets/{basket}/edit', BasketEditScreen::class)
    ->name('platform.baskets.edit')
    ->breadcrumbs(fn (Trail $trail, $basket) => $trail
        ->parent('platform.baskets.list')
        ->push(__('Basket').' #'.$basket->id, route('platform.baskets.edit', $basket)));




Route::screen('/promocodes', PromocodeListScreen::class)
    ->name('platform.promocodes.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Promocodes'), route('platform.promocodes.list')));

Route::screen('/promocodes/{promocode}/edit', PromocodeEditScreen::class)
    ->name('platform.promocode.edit')
    ->breadcrumbs(fn (Trail $trail, $promocode) => $trail
        ->parent('platform.promocodes.list')
        ->push(__('Edit').' '.__('Promocode').' №'.$promocode->id, route('platform.promocode.edit',$promocode)));


Route::screen('/promocodes/create', PromocodeEditScreen::class)
    ->name('platform.promocode.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.promocodes.list')
        ->push(__('Create').' '.__('Promocode'), route('platform.promocode.create')));


        
        
Route::screen('/payment-providers', PaymentProviderScreen::class)
    ->name('platform.payment_providers.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Payment systems'), route('platform.setting.list')));


Route::screen('/pay-methods', PaymentMethodListScreen::class)
    ->name('platform.pay_methods.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Payment options'), route('platform.pay_methods.list')));
 
Route::screen('pay-methods/{pay_method}/edit', PaymentMethodEditScreen::class)
    ->name('platform.pay_method.edit')
    ->breadcrumbs(fn (Trail $trail, $pay_method) => $trail
        ->parent('platform.pay_methods.list')
        ->push($pay_method->name, route('platform.pay_method.edit', $pay_method)));
    
Route::screen('pay-methods/create', PaymentMethodEditScreen::class)
    ->name('platform.pay_method.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.pay_methods.list')
        ->push(__('Add').' '.__('Payment options'), route('platform.pay_method.create')));

///
Route::screen('/blog-comments', BlogCommentListScreen::class)
    ->name('platform.blog_comments.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Comments under the blog'), route('platform.blog_comments.list')));
 
Route::screen('blog-comments/{blog_comment}/edit', BlogCommentEditScreen::class)
    ->name('platform.blog_comment.edit')
    ->breadcrumbs(fn (Trail $trail, $blog_comment) => $trail
        ->parent('platform.author_blogs.list')
        ->push(__('Comments under the blog').' #'.$blog_comment->id, route('platform.blog_comment.edit', $blog_comment)));
    


////

///
Route::screen('/author_blogs', AuthorPostListScreen::class)
    ->name('platform.author_blogs.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Author blog'), route('platform.author_blogs.list')));
 
Route::screen('author_blogs/{author_blog}/edit', AuthorPostEditScreen::class)
    ->name('platform.author_blog.edit')
    ->breadcrumbs(fn (Trail $trail, $author_blog) => $trail
        ->parent('platform.author_blogs.list')
        ->push($author_blog->name, route('platform.author_blog.edit', $author_blog)));
    
Route::screen('author_blogs/create', AuthorPostEditScreen::class)
    ->name('platform.author_blog.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.author_blogs.list')
        ->push(__('Add').' '.__('Blog author'), route('platform.author_blog.create')));


////


///
Route::screen('/posts', PostListScreen::class)
    ->name('platform.posts.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Blog'), route('platform.posts.list')));
 
Route::screen('posts/{post}/edit', PostEditScreen::class)
    ->name('platform.post.edit')
    ->breadcrumbs(fn (Trail $trail, $post) => $trail
        ->parent('platform.delivers.list')
        ->push($post->name, route('platform.post.edit', $post)));
    
Route::screen('posts/create', PostEditScreen::class)
    ->name('platform.post.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.posts.list')
        ->push(__('Add').' '.__('Blog'), route('platform.post.create')));


////

Route::screen('/delivers', DeliverListScreen::class)
    ->name('platform.delivers.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Deliver'), route('platform.delivers.list')));
 
Route::screen('delivers/{deliver}/edit', DeliverEditScreen::class)
    ->name('platform.deliver.edit')
    ->breadcrumbs(fn (Trail $trail, $deliver) => $trail
        ->parent('platform.delivers.list')
        ->push($deliver->name, route('platform.deliver.edit', $deliver)));
    
Route::screen('delivers/create', DeliverEditScreen::class)
    ->name('platform.deliver.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.delivers.list')
        ->push(__('Add').' '.__('Deliver'), route('platform.deliver.create')));



Route::screen('/seo-templates', SeoTemplateListScreen::class)
    ->name('platform.seo-templates.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Seo template'), route('platform.seo-templates.list')));
 
Route::screen('seo-templates/{seo_template}/edit', SeoTemplateEditScreen::class)
    ->name('platform.seo-templates.edit')
    ->breadcrumbs(fn (Trail $trail, $seo_template) => $trail
        ->parent('platform.seo-templates.list')
        ->push($seo_template->title, route('platform.seo-templates.edit', $seo_template)));
    
Route::screen('seo-templates/create', SeoTemplateEditScreen::class)
    ->name('platform.seo-templates.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.seo-templates.list')
        ->push(__('Add'), route('platform.seo-templates.create')));

/*Route::screen('/seo-product', SeoProductScreen::class)
    ->name('platform.seo-product.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Seo product'), route('platform.seo-product.list')));*/

        
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/
///////MArketing Service
Route::screen('/marketing-services', MarketingServiceListScreen::class)
    ->name('platform.marketing-services.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Marketing services'), route('platform.marketing-services.list')));
 
Route::screen('marketing-services/{marketing_service}/edit', MarketingServiceEditScreen::class)
    ->name('platform.marketing-service.edit')
    ->breadcrumbs(fn (Trail $trail, $marketing_service) => $trail
        ->parent('platform.marketing-services.list')
        ->push($marketing_service->name, route('platform.marketing-service.edit', $marketing_service)));
    
Route::screen('marketing-services/create', MarketingServiceEditScreen::class)
    ->name('platform.marketing-service.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.marketing-services.list')
        ->push(__('Add'), route('platform.marketing-service.create')));

///////Faq
Route::screen('/faqs', FaqListScreen::class)
    ->name('platform.faqs.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Faq'), route('platform.faqs.list')));
 
Route::screen('faqs/{faq}/edit', FaqEditScreen::class)
    ->name('platform.faq.edit')
    ->breadcrumbs(fn (Trail $trail, $faq) => $trail
        ->parent('platform.faqs.list')
        ->push($faq->question, route('platform.faq.edit', $faq)));
    
Route::screen('faqs/create', FaqEditScreen::class)
    ->name('platform.faqs.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.faqs.list')
        ->push(__('Add').' Faq', route('platform.faqs.create')));





// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');




// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->first_name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

        
Route::screen('/brands', BrandScreen::class)
    ->name('platform.brands.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Brand'), route('platform.brands.list')));



Route::screen('brands/{brand}/edit', BrandEditScreen::class)
    ->name('platform.brand.edit')
    ->breadcrumbs(fn (Trail $trail, $brand) => $trail
        ->parent('platform.brands.list')
        ->push($brand->name, route('platform.brand.edit', $brand)));

Route::screen('brands/create', BrandEditScreen::class)
    ->name('platform.brand.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.brands.list')
        ->push(__('Edit'), route('platform.brand.create')));

Route::screen('/categories', CategoryListScreen::class)
    ->name('platform.catogories.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Catogories'), route('platform.catogories.list')));
 
Route::screen('categories/{category}/edit', CategoryEditScreen::class)
    ->name('platform.category.edit')
    ->breadcrumbs(fn (Trail $trail, $category) => $trail
        ->parent('platform.catogories.list')
        ->push($category->name, route('platform.category.edit', $category)));
    
Route::screen('categories/create', CategoryEditScreen::class)
    ->name('platform.categories.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.catogories.list')
        ->push(__('Catogories'), route('platform.categories.create')));



///////
Route::screen('/prices', PriceListScreen::class)
    ->name('platform.prices.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Price variation'), route('platform.prices.list')));
 
Route::screen('prices/{price}/edit', PriceEditScreen::class)
    ->name('platform.price.edit')
    ->breadcrumbs(fn (Trail $trail, $price) => $trail
        ->parent('platform.prices.list')
        ->push($price->name, route('platform.price.edit', $price)));
    
Route::screen('prices/create', PriceEditScreen::class)
    ->name('platform.price.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.prices.list')
        ->push(__('Add price'), route('platform.price.create')));

///////
Route::screen('/products', ProductListScreen::class)
    ->name('platform.products.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Goods'), route('platform.products.list')));
 
Route::screen('products/{product}/edit', ProductEditScreen::class)
    ->name('platform.product.edit')
    ->breadcrumbs(fn (Trail $trail, $product) => $trail
        ->parent('platform.products.list')
        ->push($product->name, route('platform.product.edit', $product)));
    
Route::screen('products/create', ProductEditScreen::class)
    ->name('platform.product.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.products.list')
        ->push(__('Add product'), route('platform.price.create')));

///////
Route::screen('/packs', PackListScreen::class)
    ->name('platform.packs.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Pack'), route('platform.packs.list')));
 
Route::screen('packs/{pack}/edit', PackEditScreen::class)
    ->name('platform.pack.edit')
    ->breadcrumbs(fn (Trail $trail, $pack) => $trail
        ->parent('platform.packs.list')
        ->push($pack->name, route('platform.pack.edit', $pack)));
    
Route::screen('packs/create', PackEditScreen::class)
    ->name('platform.pack.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.packs.list')
        ->push(__('Add pack'), route('platform.pack.create')));

//Stock page
Route::screen('/stocks', StockListScreen::class)
    ->name('platform.stock.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Stocks'), route('platform.stock.list')));
 
Route::screen('stocks/{stock}/edit', StockEditScreen::class)
    ->name('platform.stock.edit')
    ->breadcrumbs(fn (Trail $trail, $stock) => $trail
        ->parent('platform.stock.list')
        ->push($stock->name, route('platform.stock.edit', $stock)));
    
Route::screen('stocks/create', StockEditScreen::class)
    ->name('platform.stock.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.stock.list')
        ->push(__('Add stock'), route('platform.stock.create')));

//////



///////Feedback
Route::screen('/feedbacks', FeedbackListScreen::class)
    ->name('platform.feedback.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Feedbacks'), route('platform.feedback.list')));
 
Route::screen('feedbacks/{feedback}/edit', FeedbackEditScreen::class)
    ->name('platform.feedback.edit')
    ->breadcrumbs(fn (Trail $trail, $feedback) => $trail
        ->parent('platform.feedback.list')
        ->push(__("Edit feedback",["number"=>$feedback->id]), route('platform.feedback.edit', $feedback)));
    



///////Attr
Route::screen('/attrs', AttrListScreen::class)
    ->name('platform.attr.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Attribute'), route('platform.attr.list')));
 
Route::screen('attrs/{attr}/edit', AttrEditScreen::class)
    ->name('platform.attr.edit')
    ->breadcrumbs(fn (Trail $trail, $attr) => $trail
        ->parent('platform.attr.list')
        ->push($attr->name, route('platform.attr.edit', $attr)));
    
Route::screen('attrs/create', AttrEditScreen::class)
    ->name('platform.attr.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.attr.list')
        ->push(__('Add attribute'), route('platform.attr.create')));

///////Main slider
Route::screen('/mainsliders', MainSliderListScreen::class)
    ->name('platform.mainslider.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Sliders'), route('platform.mainslider.list')));
 
Route::screen('mainsliders/{mainslider}/edit', MainSliderEditScreen::class)
    ->name('platform.mainslider.edit')
    ->breadcrumbs(fn (Trail $trail, $mainslider) => $trail
        ->parent('platform.mainslider.list')
        ->push(__("Edit slider"), route('platform.mainslider.edit', $mainslider)));
    
Route::screen('mainsliders/create', MainSliderEditScreen::class)
    ->name('platform.mainslider.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.mainslider.list')
        ->push(__('Add slider'), route('platform.mainslider.create')));

///////Page
Route::screen('/pages', PageListScreen::class)
    ->name('platform.page.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Pages'), route('platform.page.list')));
 
Route::screen('pages/{page}/edit', PageEditScreen::class)
    ->name('platform.page.edit')
    ->breadcrumbs(fn (Trail $trail, $page) => $trail
        ->parent('platform.page.list')
        ->push(__("Edit page"), route('platform.page.edit', $page)));
    
Route::screen('pages/create', PageEditScreen::class)
    ->name('platform.page.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.page.list')
        ->push(__('Add page'), route('platform.page.create')));


///////Order
Route::screen('/orders', OrderListScreen::class)
    ->name('platform.order.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Order'), route('platform.order.list')));
 
Route::screen('orders/{order}/edit', OrderEditScreen::class)
    ->name('platform.order.edit')
    ->breadcrumbs(fn (Trail $trail, $order) => $trail
        ->parent('platform.order.list')
        ->push(__("Edit order",["number"=>$order->id]), route('platform.order.edit', $order)));
    

Route::screen('/setting', SettingScreen::class)
    ->name('platform.setting.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Setting'), route('platform.setting.list')));


///////Seo filter
Route::screen('/seo-filters', SeoFilterListScreen::class)
    ->name('platform.seo-filters.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Seo filter'), route('platform.seo-filters.list')));
 
Route::screen('seo-filters/{seo_filter}/edit', SeoFilterEditScreen::class)
    ->name('platform.seo-filter.edit')
    ->breadcrumbs(fn (Trail $trail, $seo_filter) => $trail
        ->parent('platform.seo-filters.list')
        ->push(__("Edit seo attribut for filter",["number"=>$seo_filter->id]), route('platform.seo-filter.edit', $seo_filter)));
    

Route::screen('seo-filters/create', SeoFilterEditScreen::class)
    ->name('platform.seo-filters.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Add seo attribut for filter'), route('platform.seo-filters.create')));
/*Route::screen('orders/create', OrderEditScreen::class)
    ->name('platform.order.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.order.list')
        ->push(__('Add page'), route('platform.page.create')));*/
        