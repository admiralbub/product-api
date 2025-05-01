<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkrPostCity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city_id',
        'region',
        'type',
        'district',
        'district_id',
        'region_id'
    ];
    protected $appends = [
        'city_name'
    ];

    public function getCityNameAttribute() {
        return "{$this->type} {$this->name} ({$this->region} обл. р-н. {$this->district})";
    }
}
