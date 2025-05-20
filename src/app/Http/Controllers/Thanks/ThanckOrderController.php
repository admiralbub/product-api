<?php

namespace App\Http\Controllers\Thanks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\OrderInterface;
use App\Breadcrumbs\Breadcrumb;
class ThanckOrderController extends Controller
{
    public function __construct(
        public OrderInterface $order,
        public Breadcrumb $breadcrumbs
    )
    {
    }
    public function __invoke($id) {
        $bread = [
            "name"=>__("thanks_order"),
            "id"=>$id,
            "route"=>"thanks.buy",
           
   
        ];
        $breadcrumbs = $this->breadcrumbs->breadPage($bread);
        $order_result = $this->order->orderBuyThanks($id);
        return view('thanks.buy',['order'=>$order_result,'breadcrumbs'=>$breadcrumbs]);
    }
}
