<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Traits\LocalizationTrait;

class PaymentProvider extends Model
{
    use HasFactory,AsSource,LocalizationTrait;
    protected $fillable = ['key', 'value'];
    
}
