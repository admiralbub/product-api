<?php

namespace App\Enums;

enum TypePromocode: int
{
    case FIXED_PRICE = 1;
    case PERCENTAGE_DISCOUNT = 2;
    case FREE_DELIVERY = 3;
    case GIFT_PRODUCT = 4;

    public function getDescription(): string
    {
        return match ($this) {
            self::FIXED_PRICE => __('Fixed amount'),
            self::PERCENTAGE_DISCOUNT => __('Percentage discount'),
            self::FREE_DELIVERY => __('Free delivery'),
            self::GIFT_PRODUCT => __('A gift when ordering'),
        };
    }
    public function isFixedPrice() {
        return $this === self::FIXED_PRICE;
    }
    public function isPercentage_Total() {
        return $this === self::PERCENTAGE_DISCOUNT;
    }
    public function isSend() {
        return $this === self::SEND;
    }
    public function isCancel() {
        return $this === self::CANCEL;
    }
}
