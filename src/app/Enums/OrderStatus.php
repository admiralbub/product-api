<?php

namespace App\Enums;

enum OrderStatus: string
{
    case EXPECT = 'expect';
    case WORK = 'work';
    case PAY = 'pay';
    case PAID = 'paid';
    case READY = 'ready';
    case READY_TO_SHIP = 'ready_to_ship';
    case SEND = 'send';
    case CANCEL = 'cancel';
    case CREDIT = 'credit';

   
    public function isExpect() {
        return $this === self::EXPECT;
    }
    public function isWork() {
        return $this === self::WORK;
    }
    public function isPay() {
        return $this === self::PAY;
    }
    public function isPaid() {
        return $this === self::PAID;
    }
    public function isSend() {
        return $this === self::SEND;
    }
    public function isCancel() {
        return $this === self::CANCEL;
    }
   
    public function getDescription(): string
    {
        return match ($this) {
            self::EXPECT => __('New order'),
            self::WORK => __('In progress'),
            self::PAY => __('To pay'),
            self::PAID => __('Paid'),
            self::READY => __('Ready for processing'), // Add description for READY
            self::READY_TO_SHIP => __('Ready to ship'), // Add description for READY_TO_SHIP
            self::SEND => __('Sent'),
            self::CANCEL => __('Cancel order'),
            self::CREDIT => __('Credit'), // Add description for CREDIT
            default => __('Unknown status'), // Optional: handle unexpected cases
        };
    }
    
    
}