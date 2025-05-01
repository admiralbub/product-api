<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Enums\TypeDeliver;
use App\Traits\LocalizationTrait;
class Deliver extends Model
{
    use HasFactory,AsSource,LocalizationTrait;

    protected $fillable = [
        'name_ua',
        'name_ru',
        'description_ua',
        'description_ru',
        'type',
        'option',
        'available',
    ];
    protected $appends = [
        'name'
    ];
    protected $casts = [
        'type' => TypeDeliver::class,
    ];
    public function scopeAvailable($q) {
        return $q->where('available',1);
    }
    public function getApiKeyUkrPostAttribute()
    {
        $option = is_string($this->option) ? json_decode($this->option) : $this->option;

        return $option->api_key_ukr_post ?? '';
    }
}
