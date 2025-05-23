<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Traits\LocalizationTrait;
use Orchid\Filters\Filterable;
use Cviebrock\EloquentSluggable\Sluggable;
class Page extends Model
{
    use HasFactory,AsSource,LocalizationTrait,Filterable,Sluggable;
    protected $fillable = [
        'id',
        'name_ru',
        'name_ua',
        'description_ua',
        'description_ru',
        'img',
        'url',
        'status',
        'h1_ru',
        'h1_ua',
        'meta_title_ru',
        'meta_title_ua',
        'meta_description_ua',
        'meta_description_ru',
        'meta_keywords_ua',
        'meta_keywords_ru',
        'created_at',
        'is_visible',
    ];
    protected $allowedSorts = [
        'id',
        'status',
    ];
    public function scopeAvailable($q) {
        $q->where("status",1);
    }
    public function scopeVisible($q) {
        $q->where("is_visible",'1');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function sluggable(): array
    {
        return [
            'url' => [
                'source' => 'name_ua'
            ]
        ];
    }
}
