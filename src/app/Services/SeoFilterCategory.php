<?php
namespace App\Services;
 
use App\Interfaces\SeoFilterCategoryInterface;
use App\Models\Product; 
use App\Models\Category; 
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\SeoFilter;


class SeoFilterCategory implements SeoFilterCategoryInterface {
    public function getAttrFilter($filter) : array {
        $array_attr = preg_match_all('/([a-zA-Z_]+)-\d+/', $filter, $matches);
        return $matches[1];
    }
    public function  checkAttributes(array $attributes): int {
        $count = count($attributes);
        $hasBrand = in_array('brand', $attributes);
        
        if ($count === 1 && $hasBrand) {
            return 1;
        }

        if ($count === 1 && !$hasBrand) {
            return 2;
        }

        if ($count === 2 && $hasBrand) {
            return 3;
        }

        if ($count === 2 && !$hasBrand) {
            return 4;
        }

        return 0;
    }
    public function removePrefixUrlFilter() {
        $url = 'http://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];
        
       // if (substr($url, 0, strlen('&page')) === '&page') {
        if (str_contains($url, '&page')) {
            $url = strstr($url, '&page', true);
        }
        $url = urldecode($url);
        return preg_replace('#/ru/#', '/', $url, 1);
    }
    public function seoFilterCategory(Category $category, $filter) {
       // dd($this->removePrefixUrlFilter());
        $attr = $this->getAttrFilter($filter);
        $typeFilter = $this->checkAttributes($attr);
        $pointwise_seo_filter = SeoFilter::where('url',$this->removePrefixUrlFilter())->available()->latest()->first();
        if($pointwise_seo_filter) {
            $seo_filter = SeoFilter::where('url',$this->removePrefixUrlFilter())->available()->latest()->first();
        } else {
            $seo_filter = SeoFilter::where('is_template', true)
                ->where('type_filter',$typeFilter)
                ->latest()
                ->available()
                ->first();
        }

        return $seo_filter;
    }
}