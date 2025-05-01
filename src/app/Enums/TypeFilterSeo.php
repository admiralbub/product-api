<?php

namespace App\Enums;

enum TypeFilterSeo : int 
{
    case BRAND = 1;
    case ATTRIBUTE = 2;
    case BRAND_ATTRIBUTE = 3;
    case ATTRIBUTE_ATTRIBUTE = 4;

    public function getDescription(): string
    {
        return match ($this) {
            self::BRAND => __('Brand'),
            self::ATTRIBUTE => __('Attribut'),
            self::BRAND_ATTRIBUTE => __('Brand+Attribut'),
            self::ATTRIBUTE_ATTRIBUTE => __('Attribut+Attribut'),
        };
    }
}
