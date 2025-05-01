<?php

namespace App\Enums;

enum ProductMeasurements: int
{
    case LITER = 1;
    case BAG = 2;
    case TONES = 3;
    case KG = 4;
    case THING = 5;

    public function getDescription(): string
    {
        return match ($this) {
            self::LITER => __('liter'),
            self::BAG => __('bag'),
            self::TONES => __('tones'),
            self::KG => __('kg'),
            self::THING => __('thing'),
        };
    }
}
