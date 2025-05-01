<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LocalizationTrait;
use App\Enums\TypeFilterSeo;
use Orchid\Screen\AsSource;
class SeoFilter extends Model
{
    use HasFactory,LocalizationTrait,AsSource;
    protected $fillable = [
        'name_filter',
        'is_template',
        'url',
        'h1_ua',
        'h1_ru',
        'url',
        'meta_title_ua',
        'meta_title_ru',
        'meta_description_ua',
        'meta_description_ru',
        'meta_keywords_ua',
        'meta_keywords_ru',
        'description_ua',
        'description_ru',
        'category_id',
        'type_filter',
        'no_index',
        'available',
    ];
    protected $casts = [
        'type_filter' => TypeFilterSeo::class
    ];
    public function scopeAvailable($q) {
        $q->where("available",1);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function parseH1($Categoryid,$brandId, $feature_name_1, $feature_name_2)
    {
        return str_replace(
            ['{name_category}', '{brand}', '{feature_name_1}', '{feature_name_2}'],
            [
                $Categoryid ? Category::find($Categoryid)->name : '',
                $brandId ? Brand::find($brandId)->name : "",
                $feature_name_1 ? ($feature_name_1[0] ? Attr::find($feature_name_1[0])->first()->name : "") : "",
                $feature_name_2 && isset($feature_name_2[1]) ? Attr::find($feature_name_2[1])->first()->name : ""  // Check if index 1 exists in the array
            ],
            $this->h1
        );
    }
    public function parseMetaTitle($Categoryid,$brandId,$feature_name_1,$feature_name_2)
    {
        $brand = Brand::find($brandId);
        return str_replace(
            ['{name_category}','{brand}','{feature_name_1}','{feature_name_2}'],
            [
                $Categoryid ? Category::find($Categoryid)->name : '',
                $brandId ? Brand::find($brandId)->name : "",
                $feature_name_1 ? ($feature_name_1[0] ? Attr::find($feature_name_1[0])->first()->name : "") : "",
                $feature_name_2 && isset($feature_name_2[1]) ? Attr::find($feature_name_2[1])->first()->name : ""  // Check if index 1 exists in the array
            ],
            $this->meta_title
        );
    }
    public function parseMetaDescription($Categoryid,$brandId,$feature_name_1,$feature_name_2)
    {
        $brand = Brand::find($brandId);
        return str_replace(
            ['{name_category}','{brand}','{feature_name_1}','{feature_name_2}'],
            [
                $Categoryid ? Category::find($Categoryid)->name : '',
                $brandId ? Brand::find($brandId)->name : "",
                $feature_name_1 ? ($feature_name_1[0] ? Attr::find($feature_name_1[0])->first()->name : "") : "",
                $feature_name_2 && isset($feature_name_2[1]) ? Attr::find($feature_name_2[1])->first()->name : ""  // Check if index 1 exists in the array
            ],
            $this->meta_description
        );
    }
    public function parseMetaKeywords($Categoryid,$brandId,$feature_name_1,$feature_name_2)
    {
        $brand = Brand::find($brandId);
        return str_replace(
            ['{name_category}','{brand}','{feature_name_1}','{feature_name_2}'],
            [
                $Categoryid ? Category::find($Categoryid)->name : '',
                $brandId ? Brand::find($brandId)->name : "",
                $feature_name_1 ? ($feature_name_1[0] ? Attr::find($feature_name_1[0])->first()->name : "") : "",
                $feature_name_2 && isset($feature_name_2[1]) ? Attr::find($feature_name_2[1])->first()->name : ""  // Check if index 1 exists in the array
            ],
            $this->meta_keywords
        );
    }
}
