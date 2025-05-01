<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LocalizationTrait;
use Orchid\Screen\AsSource;
class Faq extends Model
{
    use LocalizationTrait,HasFactory,AsSource;

    protected $fillable = [
        'id',
        'question_ua',
        'answer_ua',
        'question_ru',
        'answer_ru',
        'available',
    ];

    public function scopeAvailable($q) {
        return $q->where('available',1);
    }
    
}
