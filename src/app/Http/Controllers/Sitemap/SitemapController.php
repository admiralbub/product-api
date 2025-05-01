<?php

namespace App\Http\Controllers\Sitemap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Page;
class SitemapController extends Controller
{
    public function __construct(
        //private Blog $blog,
        private Product $product,
        private Stock $stock,
        private Category $category,
        private Brand $brand,
        private Page $page,
    ) {

    }
    public function index()
    {

        $brands = $this->brand->orderBy('created_at', 'desc')->published()->get();
        $stocks = $this->stock->orderBy('created_at', 'desc')->available()->get();
        $products = $this->product->available()->orderBy('created_at', 'desc')->get();
        $categories = $this->category->published()->orderBy('created_at', 'desc')->get();
        $pages = $this->page->available()->orderBy('created_at', 'desc')->get();
        return response()
            ->view('sitemap.index', compact('brands', 'stocks', 'products','pages', 'categories'))
            ->header('Content-Type', 'application/xml');
    }
}
