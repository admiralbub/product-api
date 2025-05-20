<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class FoundCheaper extends Model
{
    use HasFactory,AsSource;
    protected $fillable = [
        'id',
        'name',
        'phone',
        'product_id',
        'url',
        'comment',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
