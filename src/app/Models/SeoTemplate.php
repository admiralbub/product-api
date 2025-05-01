<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Traits\LocalizationTrait;
use App\Enums\TypeSeoTemplate;
class SeoTemplate extends Model
{
    use HasFactory,AsSource,LocalizationTrait;

    protected $fillable = [
        'id',
        'title',
        'h1_ru',
        'h1_ua',
        'meta_title_ru',
        'meta_title_ua',
        'meta_description_ua',
        'meta_description_ru',
        'meta_keywords_ua',
        'meta_keywords_ru',
        'available',
        'type',
    ];
    protected $casts = [
        'type' => TypeSeoTemplate::class
    ];
    protected $appends = [
        'h1_parsed',
        'meta_title_parsed',
        'meta_description_parsed',
        'meta_keywords_parsed',
    ];
    public function scopeAvailable($q) {
        return $q->where('available',1);
    }
    public function getH1ParsedAttribute()
    {
        return $this->h1;
    }
    public function getMetaTitleParsedAttribute()
    {
        return $this->meta_title;
    }
    public function getMetaDescriptionParsedAttribute()
    {
        return $this->meta_description;
    }
    public function getMetaKeywordsParsedAttribute()
    {
        return $this->meta_keywords;
    }
    
    

    
}
