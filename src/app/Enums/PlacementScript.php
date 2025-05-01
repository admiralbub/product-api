<?php

namespace App\Enums;

enum PlacementScript: int
{
    case PLACMENT_HEAD = 1;
    // снят с производства
    case PLACMENT_BODY = 2;
    // нет в наличии
    case PLACMENT_BODYCLOSE = 3;
    // ожидается поставка

    public function getDescription(): string
    {
        return match ($this) {
            self::PLACMENT_HEAD => __('Inside the <head> tag'),
            self::PLACMENT_BODY => __('After the <body> tag'),
            self::PLACMENT_BODYCLOSE => __('Before the </body> tag'),
            default => __('Unknown status'), // Optional: handle unexpected cases
        };
    }
    public function getStatusAvailableAttribute()
    {
        return $this === self::STATUS_AVAILABLE;
    }
}
