<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\LocalizationTrait;
class Category extends Model
{
    use LocalizationTrait,HasFactory,AsSource,Sluggable;

    protected $fillable = [
        'id',
        'h1_ua',
        'h1_ru',
        'name_ru',
        'name_ua',
        'description_ru',
        'description_ua',
        'slug',
        'sort',
        'category_id',
        'is_top',
        'icon',
        'status',
        'meta_description_ru',
        'meta_description_ua',
        'meta_title_ru',
        'meta_title_ua',
        'created_at',
        'meta_keywords_ua',
        'meta_keywords_ru'
    ];
    
  

	public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
    public function seofilter(): HasMany
    {
        return $this->hasMany(SeoFilter::class);
    }
    public function childrenCategories(): HasMany
    {
        return $this->hasMany(Category::class)->with('categories');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'category_id');
    }
    public function childs()
	{
		return $this->hasMany(Category::class, 'category_id', 'id');
	}
    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function getRootCategory()
    {
        $root = $this;
        if($this->checkIsRoot($root)) {
             while (!$this->checkIsRoot($root)) {
                $root = $root->parent;
            }

        }
       
        return $root;
    }
    public function products()
	{
        return $this->belongsToMany(
            Product::class,
            'category_product',
            'category_id',
            'product_id'
        );
	}
    public function isRoot()
    {
        return self::checkIsRoot($this);
    }
    public static function checkIsRoot(Category $category)
    {
        return is_null($category->category_id) || $category->category_id <= 0;
    }
   
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name_ua',
               // 'onUpdate'=>true
            ]
        ];
    }
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
    public function getMetaTitleParsedAttribute()
    {
        if (!seo_category()) {
            return null;
        }
        $titleTemplate = seo_category()->meta_title_parsed;


        return strtr($titleTemplate, [
            '{name}' => $this->name,
          //  '{category}' => $this->showThreeCategory() ?? '',
          //  '{brand}' => $this->brand->name ?? '',
          //  '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
        
    }

    public function getMetaKeywordsParsedAttribute()
    {
        if (!seo_category()) {
            return null;
        }
        $keywordsTemplate = seo_category()->meta_keywords_parsed;


        return strtr($keywordsTemplate, [
            '{name}' => $this->name,
          //  '{category}' => $this->showThreeCategory() ?? '',
          //  '{brand}' => $this->brand->name ?? '',
          //  '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
        
    }


    public function getMetaDescriptionParsedAttribute()
    {
        if (!seo_category()) {
            return null;
        }
        $descriptionTemplate = seo_category()->meta_description_parsed;


        return strtr($descriptionTemplate, [
            '{name}' => $this->name,
           // '{category}' => $this->showThreeCategory() ?? '',
            //'{brand}' => $this->brand->name ?? '',
            //'{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
    }
    public function getH1ParsedAttribute()
    {
        if (!seo_category()) {
            return null;
        }
        $H1Template = seo_category()->h1_parsed;


        return strtr($H1Template, [
            '{name}' => $this->name,
            //'{category}' => $this->showThreeCategory() ?? '',
           // '{brand}' => $this->brand->name ?? '',
           // '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
    }
  
    
}
