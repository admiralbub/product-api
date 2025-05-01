<?php

namespace App\Http\Controllers\Deliver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Deliver\Ukrposhta;
class UkrPostController extends Controller
{
    public function getCity(Request $request) {
        $city = new Ukrposhta;
        $searchArray = $city->getCityUkrPostDB($request->city);

        return $searchArray;
    }

    public function getWarehouse(Request $request) {
        $index = new Ukrposhta;
        $searchArray = $index->getWarehousePostDB($request->city, $request->address);

        return $searchArray;
    }


    public function getRegionAll() {
        $region = new Ukrposhta;
        $title = $region->getRegionUkr();

        return $title;
    }

    public function getDistrictAll() {
        $district = new Ukrposhta;
        $title = $district->getDistrictUkr();

        return $title;
    }

    public function getCityAll() {
        $city = new Ukrposhta;
        $title = $city->getCityUkr();

        return $title;
    }
    public function getWarehouseAll() {
        $warehouse = new Ukrposhta;
        $title = $warehouse->getWarehouseUkr();

        return $title;
    }
}
