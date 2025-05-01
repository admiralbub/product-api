<?php
namespace App\Deliver;
use App\Models\UkrPostRegion;
use App\Models\UkrPostDistrict;
use App\Models\UkrPostCity;
use App\Models\UkrPostWarehouse;
use App\Jobs\UkrPost\FetchUkrPostRegion;
use App\Jobs\UkrPost\FetchUkrPostDistrict;
use App\Jobs\UkrPost\FetchUkrPostCity;
use App\Jobs\UkrPost\FetchUkrPostWarehouse;
use Illuminate\Support\Facades\Http;
use App\Models\Deliver;
use App\Enums\TypeDeliver;
class Ukrposhta {
    //private $prefix = "https://www.ukrposhta.ua/address-classifier-ws";
    /**
     * Create a new job instance.
     */
    //private $deliver;
    public function __construct()
    {
       // $this->deliver = Deliver::available()->where('type',TypeDeliver::UKRPOSHTA)->latest()->first();
    }

    public function getCityUkrPostDB($city) {
        $searchArray = UkrPostCity::where('name', 'LIKE', "%{$city}%")->get();
        $searchArray = $searchArray->sortBy(function ($settlement) {
            // Сортируем так, чтобы те, что содержат "місто", были первыми
            return stripos($settlement->type, 'м.') === false ? 1 : 0;
        })->values(); // Преобразуем обратно в массив индексов
        return $searchArray;
    }
    public function getWarehousePostDB($city,$address) {
        $searchArray = [];
        $settlements = UkrPostWarehouse::where('address', 'LIKE', "%{$address}%")->where('city_id',$city)->get();
        foreach ($settlements as $sea) {
            $searchArray[] = [
                'address'=>$sea->address,
                'postindex'=>$sea->postindex,
            ];
        }
        return $searchArray;
    }
    public function getRegionUkr() {
        UkrPostRegion::query()->delete();
        dispatch(new FetchUkrPostRegion());
        return response()->json(['message' => 'Задача поставлена в очередь для обработки']);
    }

    public function getDistrictUkr() {
        UkrPostDistrict::query()->delete();
        dispatch(new FetchUkrPostDistrict());
        

        //dispatch(new FetchUkrPostDistrict());
        return response()->json(['message' => 'Задача поставлена в очередь для обработки']);
    }

    public function getCityUkr() {
        UkrPostCity::query()->delete();
        dispatch(new FetchUkrPostCity());
        return response()->json(['message' => 'Задача поставлена в очередь для обработки']);
    }
    public function getWarehouseUkr() {
        UkrPostWarehouse::query()->delete();
        dispatch(new FetchUkrPostWarehouse());
        return response()->json(['message' => 'Задача поставлена в очередь для обработки']);
    }
}

?>