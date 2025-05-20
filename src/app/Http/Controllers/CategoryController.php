<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use App\Interfaces\ProductInterface;
use App\Interfaces\SeoFilterCategoryInterface;
use App\Breadcrumbs\Breadcrumb;
class CategoryController extends Controller
{
    public function __construct(
        private ProductInterface $productInt, 
        private Breadcrumb $breadcrumbs,
        private SeoFilterCategoryInterface $seoFilter
    )
    {
    }

    public function __invoke(Request $request,$slug, $filter = null) {
        $category = $this->productInt->getCategories($request->slug);

        if (!$category) {
            abort(404);
        }
        $breadcrumbs = $this->breadcrumbs->breadCategoryProduct($category);

        $productsCategory = $this->productInt->getProduct($category);
        $brands = $this->productInt->getBrand($productsCategory,$category);
        $price = $this->productInt->attrPrice($productsCategory,$category);

        $attrs = $this->productInt->attrProduct($productsCategory,$category);
        
        
        if($filter) {
            $seo_attr_filter = $this->seoFilter->seoFilterCategory($category, $filter);

            
            $products = $this->productInt->filterAttr($productsCategory,$filter);
          //  $products = $this->productInt->setFilter($productsCategory,$filter);
            $selectedFilter = $this->productInt->selectedFilter($filter);

            //dd($setFilterBrand );
        } else {
            if($request->get('sort')) {
                $products = $this->productInt->getSortProduct($productsCategory,$category,$request->get('sort'));
            } else if ($request->get('min_price') > 0 || $request->get('max_price') > 0) {
                $products = $this->productInt->filterPrice($request->get('min_price'),$request->get('max_price'), $productsCategory,$category);
            } else {
                $products = $this->productInt->getAllProduct($productsCategory,$category);
            }
        }
        if($request->get('ajax') == 1) {
            $page_next = $products->nextPageUrl();
            $page = 0;
            if($products instanceof \Illuminate\Pagination\AbstractPaginator) {
                $pagination = $products->appends(request()->except(['page', 'ajax']))->links()->toHtml();
            }

            return response()->json([
                "status"=>true,
                "page"=>$page,
                'page_next'=> $page_next,
                'pagination'=>$pagination,
                "success"=>view('products.items_dunamic',[
                    'products'=>$products,
                    'list_products'=>1,
                ])->render()
            ], 200);
        } else {
            return view('products.list',[
                'seo_attr_filter'=>$seo_attr_filter ?? 0,
                'category'=>$category,
                'brands'=>$brands,
                'products'=>$products,
                'price'=>$price,
                'selectedFilter'=>$selectedFilter ?? "",
                'attrs'=>$attrs,
                'breadcrumbs'=>$breadcrumbs
            ]);
        }
    
        

    }
}
