<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentProvider;
class PaymentProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
           /* [
                'name_ua'=>"Ідентифікатор магазину store_id (Оплата частими від Приват Банка)",
                'name_ru'=>"Идентификатор магазина store_id (Оплата частями от Приват Банка)",
                'groups'=>'installment_privat_bank',
                'key' => 'store_id_installment_privatbank', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Пароль магазина password (Оплата частими від Приват Банка)",
                'name_ru'=>"Пароль магазина password (Оплата частями от Приват Банка)",
                'groups'=>'installment_privat_bank',
                'key' => 'password_installment_privatbank', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"Максимальна кількість платежів (Оплата частими від Приват Банка)",
                'name_ru'=>"Максимальное количество платежей (Оплата частями от Приват Банка)",
                'groups'=>'installment_privat_bank',
                'key' => 'max_installment_privatbank', 
                'value' => '',
                'type'=>'field'
            ],

            [
                'name_ua'=>"PUMB LOGIN",
                'name_ru'=>"PUMB LOGIN",
                'groups'=>'pumb',
                'key' => 'pumb_login', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"PUMB PASSWORD",
                'name_ru'=>"PUMB PASSWORD",
                'groups'=>'pumb',
                'key' => 'pumb_password', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"PUMB MERCHANT CONFIG ID",
                'name_ru'=>"PUMB MERCHANT CONFIG ID",
                'groups'=>'pumb',
                'key' => 'pumb_merchant_config_id', 
                'value' => '',
                'type'=>'field'
            ],
            [
                'name_ua'=>"PUMB CONFIG ID",
                'name_ru'=>"PUMB CONFIG ID",
                'groups'=>'pumb',
                'key' => 'pumb_config_id', 
                'value' => '',
                'type'=>'field'
            ],
            
        ];*/
        [
            'name_ua'=>"Публічний ключ Liqpay",
            'name_ru'=>"Публичный ключ Liqpay",
            'groups'=>'liqpay',
            'key' => 'public_key_liqpay', 
            'value' => '',
            'type'=>'field'
        ],
        [
            'name_ua'=>"Приватний ключ Liqpay",
            'name_ru'=>"Приватный ключ Liqpay",
            'groups'=>'liqpay',
            'key' => 'private_key_liqpay', 
            'value' => '',
            'type'=>'field'
        ],
        ];
        PaymentProvider::insert($settings);
    }
}
