<?php
namespace App\Interfaces;
use App\Models\Order;
interface InstallmentsPrivatbankInterface {
    public function send($request,$order_id, $installment_type);
    public function callbackOrder($request);
}
?>