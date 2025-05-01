<?php

namespace App\Enums;

enum TypePaymentMethod : int
{
    case RECEIPT_OF_GOODS = 1;
    case INSTALLMENT_PRIVATBANK = 2;
    case LIQPAY = 3;
    case LEGAL_ACCOUNT_CURRENT = 4;
    case INDIVIDUALS_ACCOUNT_CURRENT = 5;
    public function getDescription(): string
    {
        return match ($this) {
            self::RECEIPT_OF_GOODS => __('Payment upon receipt of goods'),
            self::INSTALLMENT_PRIVATBANK => __('Installment payment from PivatBank'),
            self::LIQPAY => __('Liqpay'),
            self::LEGAL_ACCOUNT_CURRENT => __('Current account for legal entities'),
            self::INDIVIDUALS_ACCOUNT_CURRENT => __('Current account for individuals')
        };
    }
}
