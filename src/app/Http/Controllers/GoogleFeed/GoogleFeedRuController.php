<?php

namespace App\Http\Controllers\GoogleFeed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class GoogleFeedRuController extends Controller
{
    public function __construct(private Product $product) {

    }
    public function index()
    {
        $feedHtml ="";
        
        if(!$feedHtml) {
             $products =  $this->product->with(['categories', 'brand'])->available()->get();
             
            $feedHtml = view('google_feed.google_feed_ru', [
                'products' => $products,
               
            ])->render();

            //cache()->put(self::CACHE_KEY, $feedHtml, now()->addHours(3));
        }

        return response($feedHtml)
            ->header(
                'Content-Type', 'text/xml'
            );
    }
}
