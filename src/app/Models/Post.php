<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Traits\LocalizationTrait;

class Post extends Model
{
    use HasFactory, AsSource, LocalizationTrait, Sluggable;

    protected $fillable = [
        'name_ua',
        'name_ru',
        'description_ua',
        'description_ru',
        'slug',
        'h1_ua',
        'img',
        'h1_ru',
        'author_id',
        'meta_title_ua',
        'meta_title_ru',
        'meta_description_ua',
        'meta_description_ru',
        'meta_keywords_ua',
        'meta_keywords_ru',
        'available',
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
    ];
    public function scopeAvailable($q) {
        $q->where("available", 1);
    }
    public static function boot()
    {
        parent::boot();

 

        static::creating(function ($model) {
            $model->meta_title_ua = $model->name_ua;
            $model->meta_title_ru = $model->name_ru;
            $model->meta_description_ua = $model->name_ua;
            $model->meta_description_ru = $model->name_ru;
            $model->h1_ru = $model->name_ru;
            $model->h1_ua = $model->name_ua;
            $model->meta_keywords_ua = '';
            $model->meta_keywords_ru = '';
        });
    }
    public function getMetaTitleParsedAttribute()
    {
        if (!seo_blog()) {
            return null;
        }
        $titleTemplate = seo_blog()->meta_title_parsed;


        return strtr($titleTemplate, [
            '{name}' => $this->name,
           
        ]);
        
    }
    public function author()
    {
        return $this->belongsTo(AuthorPost::class);
    }

    public function comment()
    {
        return $this->hasMany(BlogComment::class)->available();
    }
    public function getMetaKeywordsParsedAttribute()
    {
        if (!seo_blog()) {
            return null;
        }
        $keywordsTemplate = seo_blog()->meta_keywords_parsed;


        return strtr($keywordsTemplate, [
            '{name}' => $this->name,
           
        ]);
        
    }


    public function getMetaDescriptionParsedAttribute()
    {
        if (!seo_blog()) {
            return null;
        }
        $descriptionTemplate = seo_blog()->meta_description_parsed;


        return strtr($descriptionTemplate, [
            '{name}' => $this->name,
           
        ]);
    }
    public function getH1ParsedAttribute()
    {
        if (!seo_blog()) {
            return null;
        }
        $H1Template = seo_blog()->h1_parsed;


        return strtr($H1Template, [
            '{name}' => $this->name,
           
        ]);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_ua'
            ]
        ];
    }
}