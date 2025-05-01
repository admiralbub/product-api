<?php

namespace App\Enums;

enum ProductStatus: int
{
    case STATUS_AVAILABLE = 1;
    // снят с производства
    case STATUS_OUT_OF_PRODUCTION = 2;
    // нет в наличии
    case STATUS_UNAVAILABLE = 3;
    // ожидается поставка
    case STATUS_EXPECTED = 4;

    public function getDescription(): string
    {
        return match ($this) {
            self::STATUS_AVAILABLE => __('Available'),
            self::STATUS_OUT_OF_PRODUCTION => __('Discontinued'),
            self::STATUS_UNAVAILABLE => __('Out of stock'),
            self::STATUS_EXPECTED => __('Expected delivery'),
            default => __('Unknown status'), // Optional: handle unexpected cases
        };
    }
    public function getStatusAvailableAttribute()
    {
        return $this === self::STATUS_AVAILABLE;
    }
}
