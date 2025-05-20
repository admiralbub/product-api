<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use App\Enums\OrderStatus;
use App\Enums\TypeDeliver;
use App\Enums\TypePaymentMethod;
class Order extends Model
{
    use HasFactory,AsSource,Filterable;

    protected $fillable = [
		'id',
		'user_id',
		'first_name',
		'last_name',
		'middle_name',
		'phone',
		'email',
		'comment',
		'is_pay',
		'total',
		'status',
		'delivery',
		'pay_info',
		'user_id',
		'pay_amount',
		'total_promocode',
		'promocode_id'
		
        
	];  
	protected $allowedSorts = [
        'id',
        'created_at',
        'is_publish'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
		'status' => OrderStatus::class,
    ];
    public function user()
	{
		return $this->belongsTo(User::class,'user_id','id');
	}
	public function promocode()
	{
		return $this->belongsTo(Promocode::class,'promocode_id','id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function products()
	{
		return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot(['price', 'quantity']);
	}
	
	static public function getDeliverTextAttribute(): array
	{
		$deliver_type = [];

		foreach (TypeDeliver::cases() as $case) {
			$deliver_type[$case->name] = $case->value;
		}
		return $deliver_type;
	}
	static public function getDeliverListTypeAttribute() {
		$result = [];

		foreach (TypeDeliver::cases() as $case) {
			$deliver = Deliver::where('type', $case->value)->first();

			$result[$case->name] = $deliver->name ?? $case->getDescription();
		}

		return $result;
	}
	//////////////////////////////////////////////////////////////////////
	static public function getPayTextAttribute(): array
	{
		$pay_type = [];

		foreach (TypePaymentMethod::cases() as $case) {
			$pay_type[$case->name] = $case->value;
		}
		return $pay_type;
	}
	static public function getPayListTypeAttribute() {
		$result = [];

		foreach (TypePaymentMethod::cases() as $case) {
			$pay = PaymentMethod::where('type', $case->value)->first();

			$result[$case->name] = $pay->name ?? $case->getDescription();
		}

		return $result;
	}


	///////////////////////////////////////////////////////////////////////



	/*static public function getPayTextAttribute()
	{
		return [
			'Default_pay'=>__('Payment per hour of picking up the goods'),
		];
	}*/
	
	public function getDeliverNameAttribute()
    {
        $deliverType = json_decode($this->delivery)->deliver ?? '';
		if (!$deliverType) {
			return null;
		}
		$deliver = Deliver::available()->where('type', $this->deliver_text[$deliverType])->first();
		return $deliver->name;
    }

	public function getPayNameAttribute()
    {
        $payType = json_decode($this->pay_info)->pay_title ?? '';
		if (!$payType) {
			return null;
		}
		$pay = PaymentMethod::available()->where('type', $this->pay_text[$payType])->first();
		return $pay->name;
    }

	public function getDeliverTypeAttribute()
    {
        return json_decode($this->delivery)->deliver ? json_decode($this->delivery)->deliver ?? '' : '';
    }
	public function getNpCityAttribute()
    {
        return json_decode($this->delivery)->city_np ? json_decode($this->delivery)->city_np ?? '' : '';
    }
	public function getUkrPostCityAttribute()
    {
        return json_decode($this->delivery)->city_ukr_post ? json_decode($this->delivery)->city_ukr_post ?? '' : '';
    }
	public function getUkrPostWarehouseAttribute()
    {
        return json_decode($this->delivery)->warehouse_ukr_pos ? json_decode($this->delivery)->warehouse_ukr_pos ?? '' : '';
    }



	public function getNpSelfAddressAttribute()
	{
		$delivery = json_decode($this->delivery);
		return $delivery->np_self_address ?? '';
	}
	public function getNpCourierAddressAttribute()
    {
		{
			$delivery = json_decode($this->delivery);
			return $delivery->np_courier_address ?? '';
		}
      //  return json_decode($this->delivery)->np_courier_address ? json_decode($this->delivery)->np_courier_address ?? '' : '';
    }

	public function getNpCityRefAttribute()
    {
        return json_decode($this->delivery)->city_ref ? json_decode($this->delivery)->city_ref ?? '' : '';
    }



	public function getNpWarehouseRefAttribute()
    {
        return json_decode($this->delivery)->warehouse_ref ? json_decode($this->delivery)->warehouse_ref ?? '' : '';
    }
	public function getNpWarehouseAttribute()
    {
        return json_decode($this->delivery)->warehouse_np ? json_decode($this->delivery)->warehouse_np ?? '' : '';
    }
	
	public function getNpCityIdAttribute() {
		return NpCity::where('Ref',json_decode($this->delivery)->city_ref ?? '')->pluck('id')->first() ?? '';
	}
	public function getNpWarehouseIdAttribute() {
		return NpWarehouse::where('Ref',json_decode($this->delivery)->warehouse_ref ?? '')->pluck('id')->first();
	}

	public function getUkrPostCityIdAttribute() {
		return UkrPostCity::where('city_id',json_decode($this->delivery)->id_city_ukr_post ?? '')->pluck('id')->first() ?? '';
	}

	public function getUkrPostWarehouseIdAttribute() {
		return UkrPostWarehouse::where('postindex',json_decode($this->delivery)->postcode_warehouse_ukr_pos ?? '')->pluck('id')->first() ?? '';
	}

	public function getPayTypeAttribute()
    {
        return json_decode($this->pay_info)->pay_title ? json_decode($this->pay_info)->pay_title ?? '' : '';
    }
	public function getPayTitleAttribute()
    {
        return $this->pay_text[json_decode($this->pay_info)->pay_title ? json_decode($this->pay_info)->pay_title ?? '' : ''];
    }
	public function getCreditCountAttribute()
    {
		$payInfo = json_decode($this->pay_info);
		return $payInfo->credit_pb_count ?? '';
    }
	
	public function getTypeInstallmentAttribute()
    {
		$payInfo = json_decode($this->pay_info);
		return $payInfo->credit_pb_type ?? '';
    }
	public function getEdrpuLegalAttribute()
    {
		$payInfo = json_decode($this->pay_info);
		return $payInfo->edrpu_legal ?? '';
    }
	public function getFullNameLegalAttribute()
    {
		$payInfo = json_decode($this->pay_info);
		return $payInfo->full_name_legal ?? '';
    }
	public function getFullNameAcountAttribute()
    {
		$payInfo = json_decode($this->pay_info);
		return $payInfo->full_name_acount ?? '';
    }
	public function getTinAcountAttribute()
    {
		$payInfo = json_decode($this->pay_info);
		return $payInfo->tin_acount ?? '';
    }

	
	
}
