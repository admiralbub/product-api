<?php
namespace App\Interfaces;
use App\Models\Order;
interface OrderInterface {
   static public function getOrderAdd($request,$totalBasket,$total_promocode=0);
   static public function getProductAdd($baskets,$order_id);
   static public function showOrderAccount();
   static public function setProductOneClick($id);

   static public function getOneClickAdd($request,$price);
   static public function getOneClickAddProduct($order_id,$baskets);
   static public function sendEmailOrder();
   static public function orderBuyThanks($id);
   static public function banUser($phone,$email);
  /* static public function getOrderPromocode($promocode,$totalBasket);*/
}

?>