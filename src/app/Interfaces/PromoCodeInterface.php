<?php
namespace App\Interfaces;
use App\Models\Promocode;
interface PromoCodeInterface {
    public function getTotalPromocode($promocode,$totalBasket);
    public function getPromocodeValidation($promocode,$totalBasket);
    //public function getMinTotalActivationPromocode($promocode,$totalBasket);
}