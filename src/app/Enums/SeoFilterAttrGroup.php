<?php

namespace App\Enums;

enum SeoFilterAttrGroup : string
{
    case BRAND = 'brand';
    case CULT = 'cult';
    case ANALOG = 'analog';
    case SUB = 'sub';

    public function getDescription(): string
    {
        return match ($this) {
            self::CULT => __('Culture'),
            self::BRAND => __('Brand'),
            self::ANALOG =>  __('Analog'),
            self::SUB => __('Active ingredient'),
            default => __('Unknown status'), // Optional: handle unexpected cases
        };
    }
}
