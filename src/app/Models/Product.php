<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Cviebrock\EloquentSluggable\Sluggable;
use Orchid\Filters\Filterable;
use App\Traits\LocalizationTrait;
use App\Enums\ProductStatus;
use App\Enums\ProductMeasurements;
class Product extends Model
{
    use LocalizationTrait,HasFactory,AsSource,Sluggable,Filterable;
    protected $fillable = [
        'name_ua',
        'name_ru',
        'h1_ua',
        'h1_ru',
        'meta_title_ua',
        'meta_title_ru',
        'meta_description_ua',
        'meta_description_ru',
        'meta_keywords_ua',
        'meta_keywords_ru',
        'image',
        'description_ua',
        'description_ru',
        'brand_id',
        'stock_id',
        'page_id',
        'price',
        'price_stock',
        'status',
        'is_new',
        'old_price',
        'is_top',
        'unit',
        'is_recommender',
        'wholesale',
        'is_publish',
        'is_sale',
        'slug',
        'hide_from_categories',
        'id',
    ];
    protected $allowedSorts = [
        'id',
        'created_at',
        'is_publish'
    ];
    protected $casts = [
        'wholesale' => 'array',
        'status' => ProductStatus::class,
        'unit' => ProductMeasurements::class
    ];
    protected $appends = [
        'meta_title_parsed',
        'meta_description_parsed',
        'h1_parsed',

        'name'
    ];
    protected $lang_fields = [
        'name',
        'h1',
        'title',
        'description',
        'meta'
    ];
    public function scopeNew($q) {
        $q->where("is_new",1);
    }
    
    public function scopeReccomended($q) {
        $q->where("is_recommender",1);
    }
    public function scopePopular($q) {
        $q->where("is_top",1);
    }

    public function scopeSale($q) {
        $q->where("is_sale",1);
    }
    public function scopeAvailable($q) {
        $q->where("is_publish",1);
    }
    
    public function feedback()
    {
        return $this->hasMany(Feedback::class)->available();
    }
    public function packs()
    {
        return $this->belongsToMany(Pack::class,'pack_product','product_id','pack_id' );
    }
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name_ua',
                //'onUpdate'=>true
            ]
        ];
    }
   
    
   
   
  
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function stocks()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }

    public function prices()
    {
        return $this->belongsToMany(
            Price::class,
            'price_product',
            'price_id',
            'product_id'
        );
    }
    public function attrs()
    {
        return $this->belongsToMany(
            Attr::class,
            'attr_product',
            'product_id',
            'attr_id',
        );
    }
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_product',
            'product_id',
            'category_id'
        );
    }
    public function getWholesaleP3Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p3'] ?? 0) : 0;
    }

    public function getWholesaleP10Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p10'] ?? 0) : 0;
    }
    public function getWholesaleP11Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p11'] ?? 0) : 0;
    }
    public function getWholesaleP12Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p12'] ?? 0) : 0;
    }

    public function getWholesaleP13Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p13'] ?? 0) : 0;
    }
    public function getWholesaleP14Attribute()
    {
        return $this->wholesale ? floatval($this->wholesale['p14'] ?? 0) : 0;
    }
    public function scopePublished($query)
    {
        return $query->where('is_publish', 1);
    }
   
    public function scopeIsCategory($query)
    {
        return $query->where('hide_from_categories', 0);
    }

    
    public static function boot()
    {
        parent::boot();

 

        static::creating(function ($model) {
          //  $model->title_ru = 'Купить {name} в Украине по лучшей цене от компании Growex';
           // $model->meta_ru = 'Только В магазине Гровекс {name} и другие {category}  лучшего качества, по самой доступной цене в Украине | Growex';
            $model->meta_title_ua = $this->name_ua;
            $model->meta_title_ru = $this->name_ru;
            $model->meta_description_ua = $this->name_ua;
            $model->meta_description_ru = $this->name_ru;
            $model->h1_ru = $this->name_ru;
            $model->h1_ua = $this->name_ua;
            $model->meta_keywords_ua = '';
            $model->meta_keywords_ru = '';

            
        });
    }
    public function getMetaTitleParsedAttribute()
    {
        if (!seo_product()) {
            return null;
        }
        $titleTemplate = seo_product()->meta_title_parsed;


        return strtr($titleTemplate, [
            '{name}' => $this->name,
            '{category}' => $this->showThreeCategory() ?? '',
            '{brand}' => $this->brand->name ?? '',
            '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
        
    }

    public function getMetaKeywordsParsedAttribute()
    {
        if (!seo_product()) {
            return null;
        }
        $keywordsTemplate = seo_product()->meta_keywords_parsed;


        return strtr($keywordsTemplate, [
            '{name}' => $this->name,
            '{category}' => $this->showThreeCategory() ?? '',
            '{brand}' => $this->brand->name ?? '',
            '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
        
    }


    public function getMetaDescriptionParsedAttribute()
    {
        if (!seo_product()) {
            return null;
        }
        $descriptionTemplate = seo_product()->meta_description_parsed;


        return strtr($descriptionTemplate, [
            '{name}' => $this->name,
            '{category}' => $this->showThreeCategory() ?? '',
            '{brand}' => $this->brand->name ?? '',
            '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
    }
    public function getH1ParsedAttribute()
    {
        if (!seo_product()) {
            return null;
        }
        $H1Template = seo_product()->h1_parsed;


        return strtr($H1Template, [
            '{name}' => $this->name,
            '{category}' => $this->showThreeCategory() ?? '',
            '{brand}' => $this->brand->name ?? '',
            '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
    }
    public function showThreeCategory() {
        $cateroris_name = $this->categories->map(
            function ($item) {
                $category = $item->getRootCategory() ?? 0;
                if ($category && $category->parent_id == null) {
                    $category = $item->first();
                }
                if ($category && $category->parent && $category->parent->parent) {
                    if($category->parent->parent->parent) {
                        $category = $category->parent->parent->parent;
                    } else {
                        $category = $category->parent;
                    }
                    
                }
                
                if (!$category) {
                    $category = $item->first();
                }
                return $category;
            });
        return $cateroris_name->first()->name ;
    }
    
}
