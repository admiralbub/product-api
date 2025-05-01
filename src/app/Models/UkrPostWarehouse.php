<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkrPostWarehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'postindex',
        'address',
        'city_id',
        'district_id',
        'region_id'

    ];
}
