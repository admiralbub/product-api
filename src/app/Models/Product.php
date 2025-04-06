<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'name',
        'price',
        'category',
        'attributes',
        'created_at'
    ];

    protected $casts = [
        'attributes' => 'array',
        'created_at' => 'datetime:Y-m-d H:i',

    ];
    
}
