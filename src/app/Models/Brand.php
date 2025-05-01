<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Traits\LocalizationTrait;
class Brand extends Model
{
    use Sluggable,HasFactory,AsSource,Filterable,LocalizationTrait;

    protected $fillable = [
        'id',
        'h1_ua',
        'h1_ru',
        'name_ru',
        'name_ua',
        'images',
        'description_ru',
        'description_ua',
        'slug',
        'status',
        'meta_description_ru',
        'meta_description_ua',
        'meta_title_ru',
        'meta_title_ua',
        'created_at',
        'meta_keywords_ua',
        'meta_keywords_ru'
    ];
    protected $allowedSorts = [
        'id',
        'status'
    ];
    public function products()
	{
		return $this->hasMany(Product::class);
	}
    public function scopePublished($query)
    {
        return $query->where('status', 1);
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

    public function getMetaTitleParsedAttribute()
    {
        if (!seo_brand()) {
            return null;
        }
        $titleTemplate = seo_brand()->meta_title_parsed;


        return strtr($titleTemplate, [
            '{name}' => $this->name,
          //  '{category}' => $this->showThreeCategory() ?? '',
          //  '{brand}' => $this->brand->name ?? '',
          //  '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
        
    }

    public function getMetaKeywordsParsedAttribute()
    {
        if (!seo_brand()) {
            return null;
        }
        $keywordsTemplate = seo_brand()->meta_keywords_parsed;


        return strtr($keywordsTemplate, [
            '{name}' => $this->name,
          //  '{category}' => $this->showThreeCategory() ?? '',
          //  '{brand}' => $this->brand->name ?? '',
          //  '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
        
    }


    public function getMetaDescriptionParsedAttribute()
    {
        if (!seo_brand()) {
            return null;
        }
        $descriptionTemplate = seo_brand()->meta_description_parsed;


        return strtr($descriptionTemplate, [
            '{name}' => $this->name,
           // '{category}' => $this->showThreeCategory() ?? '',
            //'{brand}' => $this->brand->name ?? '',
            //'{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
    }
    public function getH1ParsedAttribute()
    {
        if (!seo_brand()) {
            return null;
        }
        $H1Template = seo_brand()->h1_parsed;


        return strtr($H1Template, [
            '{name}' => $this->name,
            //'{category}' => $this->showThreeCategory() ?? '',
           // '{brand}' => $this->brand->name ?? '',
           // '{pack_name}' => $this->packs->sortBy('pivot.add_time')->first()->name ?? "",
           
        ]);
    }
}
