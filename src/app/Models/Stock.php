<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use Modules\Comments\Entities\Comments;
use Psy\Util\Str;
use Orchid\Screen\AsSource;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use App\Traits\LocalizationTrait;
class Stock extends Model
{

    use AsSource,Sluggable,Filterable,LocalizationTrait;

	protected $fillable = [
        'id',
	    'name_ua',
        'name_ru',
        'start_stocks_date',
        'end_stocks_date',
        'slug',
        'h1_ua',
        'h1_ru',
        'meta_title_ua',
        'meta_title_ru',
        'meta_description_ua',
        'meta_description_ru',
        'meta_keywords_ua',
        'meta_keywords_ru',
        'img',
        'body_ua',
        'body_ru',
        'status',
        
    ];

    protected $allowedFilters = [
        'id'  => Where::class,
        'status'=> Where::class,
    
    ];

     protected $allowedSorts = [
        'id',
    ];
    protected $appends = [
        'meta_title_parsed',
        'meta_description_parsed',
        'h1_parsed',
    ];
    /**
     * @param $name
     * @param bool $defaultLocaleWhenEmpty
     * @return mixed
     */
 
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
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('start_stocks_date', '<=', Carbon::now())->whereDate('end_stocks_date', '>=', Carbon::now());
    }

    public function getMetaTitleParsedAttribute()
    {
        if (!seo_stock()) {
            return null;
        }
        $titleTemplate = seo_stock()->meta_title_parsed;


        return strtr($titleTemplate, [
            '{name}' => $this->name,
          //  '{category}' => $this->showThreeCategory() ?? '',
          //  '{brand}' => $this->brand->name ?? '',
          //  '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
        
    }

    public function getMetaKeywordsParsedAttribute()
    {
        if (!seo_stock()) {
            return null;
        }
        $keywordsTemplate = seo_stock()->meta_keywords_parsed;


        return strtr($keywordsTemplate, [
            '{name}' => $this->name,
          //  '{category}' => $this->showThreeCategory() ?? '',
          //  '{brand}' => $this->brand->name ?? '',
          //  '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
        
    }


    public function getMetaDescriptionParsedAttribute()
    {
        if (!seo_stock()) {
            return null;
        }
        $descriptionTemplate = seo_stock()->meta_description_parsed;


        return strtr($descriptionTemplate, [
            '{name}' => $this->name,
           // '{category}' => $this->showThreeCategory() ?? '',
            //'{brand}' => $this->brand->name ?? '',
            //'{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
    }
    public function getH1ParsedAttribute()
    {
        if (!seo_stock()) {
            return null;
        }
        $H1Template = seo_stock()->h1_parsed;


        return strtr($H1Template, [
            '{name}' => $this->name,
            //'{category}' => $this->showThreeCategory() ?? '',
           // '{brand}' => $this->brand->name ?? '',
           // '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
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
    
}
