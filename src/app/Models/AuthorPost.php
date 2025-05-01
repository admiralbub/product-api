<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Traits\LocalizationTrait;
class AuthorPost extends Model
{
    use HasFactory,AsSource,LocalizationTrait;

    protected $fillable = [
        'name_ru',
        'name_ua',
        'img',
        'description_ua',
        'description_ru',
        'available'


    ];
    protected $appends = [
        'name',


    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeAvailable($q) {
        return $q->where('available',1);
    }
}
