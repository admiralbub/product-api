<?php

namespace App\Enums;

enum TypeDeliver : int
{
    case NP = 1;
    case NP_COURIER = 2;
    case WAREHOUSE_REMOVAL = 3;
    case SELF_DELIVERY = 4;
    case UKRPOSHTA = 5;


    public function getDescription(): string
    {
        return match ($this) {
            self::NP => __('Nova Poshta'),
            self::NP_COURIER => __('New Post (courier)'),
            self::WAREHOUSE_REMOVAL => __('Pickup from the warehouse'),
            self::SELF_DELIVERY => __('Pickup'),
            self::UKRPOSHTA => __('Ukrposhta'),
        };
    }
    
    
   
}
