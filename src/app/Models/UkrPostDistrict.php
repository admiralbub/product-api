<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkrPostDistrict extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region_id',
        'district_id'
    ];

    
}
