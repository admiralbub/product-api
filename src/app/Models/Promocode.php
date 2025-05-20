<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Carbon\Carbon;
use App\Enums\TypePromocode;
class Promocode extends Model
{
    use HasFactory,AsSource;

    protected $fillable = [
        'name_promocode',
        'code',
        'min_total_activation',
        'start_promocode_date',
        'end_promocode_date',
        'type_promocode',
        'fixed_price',
        'percentage_price',
        'product_id',
        'available',
        'start_promocode_date',
        'end_promocode_date',
        'min_total_activation'
    ];
    
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }

    public function scopeDateActivation($query)
    {
        return $query
            ->whereNotNull('start_promocode_date')
            ->whereNotNull('end_promocode_date')
            ->where('start_promocode_date', '<=', Carbon::now())
            ->whereDate('end_promocode_date', '>=', Carbon::now());
    }

    public function scopeMinTotalActivation($query, $total)
    {
        return $query->where(function ($q) use ($total) {
            $q->whereNull('min_total_activation')
            ->orWhere('min_total_activation', '<=', $total);
        });
    }

    static public function getPromocodeTextAttribute(): array
	{
		$promocode_type = [];

		foreach (TypePromocode::cases() as $case) {
            $promocode_type[$case->value] = $case->getDescription();
        }
		return $promocode_type;
	}
    public function getPromocodeNameAttribute()
    {
        return $this->promocode_text[$this->type_promocode];
    }
}
