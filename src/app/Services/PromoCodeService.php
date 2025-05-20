<?php
namespace App\Services;
 
use App\Interfaces\PromoCodeInterface;
use App\Models\Promocode;


class PromoCodeService implements PromoCodeInterface {
    public function getTotalPromocode($promocode,$totalBasket) {
        $promocod = Promocode::where('code',$promocode)
            ->MinTotalActivation($totalBasket)
            ->available()
            ->dateActivation()
            ->first();

        if(!$promocod) {
            return $totalBasket;
        }
        
        switch($promocod->type_promocode) {
            case 1:
                $totalBasket = $totalBasket - $promocod->fixed_price;
                break;
            case 2:
                $totalBasket = $totalBasket - ($totalBasket * ($promocod->percentage_price / 100));
                break;
        }
        return max($totalBasket, 0);
    }
    public function getPromocodeValidation($promocode,$totalBasket) {
        
    
        $isValid = Promocode::where('code', $promocode)
            ->MinTotalActivation($totalBasket)
            ->available()
            ->dateActivation()
            ->exists();
    
        return $isValid;
        
        
    }
}

?>