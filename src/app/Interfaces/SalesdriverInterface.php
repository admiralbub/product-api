<?php
namespace App\Interfaces;
use App\Models\Order;
use App\Models\Product;
interface SalesdriverInterface {
    public function addOrderinCrm($orderId);
    public function exportProductSalesdriver() : Array;
    public function updateStatusOrderCrm($data);

    public function updateStatusCrm($orderId, $statusId);
}