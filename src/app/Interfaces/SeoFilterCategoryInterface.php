<?php
namespace App\Interfaces;
use App\Models\SeoFilter;
use App\Models\Category; 
interface SeoFilterCategoryInterface {
    public function seoFilterCategory(Category $category, $filter);
    public function getAttrFilter($filter) : array;
    public function  checkAttributes(array $attributes): int;
    public function removePrefixUrlFilter();
}