<?php

namespace App\Enums;

enum TypeSeoTemplate : int
{
    case BRAND = 1;
    case PRODUCT = 2;
    case CATEGORY = 3;
    case STOCK = 4;
    case BLOG = 5;
    public function getDescription(): string
    {
        return match ($this) {
            self::BRAND => __('Brand'),
            self::PRODUCT => __('Products'),
            self::CATEGORY => __('Product categories'),
            self::STOCK => __('Stock'),
            self::BLOG => __('Blog'),
        };
    }
}
