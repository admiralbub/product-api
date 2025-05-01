<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class MarketingService extends Model
{
    use HasFactory,AsSource;
    protected $fillable = [
        'id',
        'name',
        'available',
        'script',
        'placement',
    ];

    public function scopeAvailable($q) {
        $q->where("available",1);
    }
    public function scopeHead($q) {
        $q->where("placement",1);
    }
    public function scopeBody($q) {
        $q->where("placement",2);
    }
    public function scopeBodyClose($q) {
        $q->where("placement",3);
    }
}
