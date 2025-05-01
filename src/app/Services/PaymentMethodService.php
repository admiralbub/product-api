<?php
namespace App\Services;
 
use App\Interfaces\PaymentMethodInterface;

use App\Models\PaymentMethod; 

class PaymentMethodService implements PaymentMethodInterface {
    public function getListPaymentMethod() {
        return PaymentMethod::available()->get();
    }

}

?>