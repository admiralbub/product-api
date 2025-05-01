<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Traits\LocalizationTrait;
use App\Enums\TypePaymentMethod;
class PaymentMethod extends Model
{
    use HasFactory,AsSource,LocalizationTrait;

    protected $fillable = [
        'id',
        'name_ua',
        'name_ru',
        'description_ua',
        'description_ru',
        'available',
        'type'
    ];
    protected $casts = [
        'type' => TypePaymentMethod::class,
    ];
    public function scopeAvailable($q) {
        $q->where("available", 1);
    }
}
