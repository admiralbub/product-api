<?php

namespace App\Actions\Order;
use App\Models\Order;
use App\Models\Promocode;
use App\Enums\OrderStatus;
class OrderAction
{
    /**
     * Create a new class instance.
     */
    public function execute($request, $delivery_order,$pay_info,$total_summ_order,$total_promocode = 0): Order
    {
        $order = Order::create([
            'user_id'=>auth()->check() ? auth()->user()->id : NULL,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'middle_name'=>$request->middle_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'comment'=>$request->notes_order,
            'delivery'=>$delivery_order,
            'pay_info'=>$pay_info,
            'status'=>OrderStatus::EXPECT,
            'total'=>$total_summ_order,
            'promocode_id'=>Promocode::where('code',$request->promocode)->MinTotalActivation($total_summ_order)->available()->dateActivation()->value('id'),
            'total_promocode'=>$total_promocode
        ]);
        
        return $order;
        
    }
}