<?php
namespace App\Services;
 
use App\Interfaces\OrderInterface;

use App\Models\Order; 
use App\Models\Product; 
use App\Models\Promocode; 
use App\Models\BanUser; 
use App\Actions\Order\OrderAction;
use App\Actions\Order\OrderProductAction;

use App\Actions\Order\OrderOneClickAction;
use Snowfire\Beautymail\Beautymail;
use App\Actions\Order\AddProductOneClickAction;
class OrderService implements OrderInterface {
    
    
    /*static public function getOrderPromocode($promocode,$totalBasket) {
        $promocod = Promocode::where('code',$promocode)->available()->dateActivation()->first();
        if(isset($promocod)) {
            if($promocod->type_promocode == 1) {
                $totalBasket = $totalBasket - $promocod->fixed_price;
            } else if($promocod->type_promocode == 2)   {
                $totalBasket = $totalBasket - ($totalBasket * ($promocod->percentage_price / 100));
            } else {
                $totalBasket = $totalBasket;
            }
            
        }
        return $totalBasket;
        
    }*/

    static public function getOrderAdd($request,$totalBasket,$total_promocode=0) {
        //dd($request);
        $delivery_order = [
            'deliver' => $request->deliver ?? '',
            'city_np' => $request->city_np ?? '',
            'warehouse_np' => $request->warehouse_np ?? '',
            'city_ref' => $request->city_ref_np ?? '',
            'warehouse_ref' => $request->warehouse_ref_np ?? '',

            'np_self_address' => $request->np_self_address ?? '',
            'np_courier_address' => $request->np_courier_address ?? '',

            'city_ukr_post' => $request->ukr_post_city ?? '',
            'warehouse_ukr_pos' => $request->ukr_post_warehouse ?? '',

            'id_city_ukr_post' => $request->ukr_post_id_city ?? '',
            'postcode_warehouse_ukr_pos' => $request->ukr_post_post_code ?? '',


        ];
      //  dd( $request->city_np );

        $delivery_order = json_encode($delivery_order);

        $pay_info = [
            'pay_title' => $request->pay ?? '',
            'credit_pb_type' => $request->credit_PP ? "PP" : "II",
            'credit_pb_count' => $request->credit_PP ? $request->count_PP : $request->count_II,
            'edrpu_legal'=>$request->edrpu_legal ?? '',
            'full_name_legal'=>$request->full_name_legal ?? '',
            'full_name_acount'=>$request->full_name_acount ?? '',
            'tin_acount'=>$request->tin_acount ?? '',

        ];
   
        $pay_info = json_encode($pay_info);
       // $total_promocode = 0;
       


        $order = (new OrderAction())->execute($request,$delivery_order,$pay_info,$totalBasket,$total_promocode);
        return $order->id;
    }
    static public function getProductAdd($baskets,$order_id) {
        foreach ($baskets as $product) {
            (new OrderProductAction())->execute($product,$order_id);
        }
    }
    static public function showOrderAccount() {
        return Order::where('user_id',auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(8);
    }

    static public function setProductOneClick($id) {
        $product = Product::where('id',$id)->available()->first();
        return $product;
    }
    static public function getOneClickAdd($request,$price) {
        $delivery_order = [
            'deliver' =>  '',
            'city_np' =>  '',
            'warehouse_np' => '',
            'city_ref' => '',
            'warehouse_ref' => '',
        ];

        $delivery_order = json_encode($delivery_order);

        $pay_info = [
            'pay_title' =>  '',
        ];
   
        $pay_info = json_encode($pay_info);
        $order = (new OrderOneClickAction())->execute($request,$delivery_order,$pay_info,$price);
        return $order->id;
    }
    static public function getOneClickAddProduct($order_id,$baskets) {
        return (new AddProductOneClickAction())->execute($baskets,$order_id);
    }
    static public function sendEmailOrder() {

        $order_last = Order::latest()->first();
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('email.order', ['id'=>$order_last->id,'name'=>$order_last->first_name,'products'=>$order_last->products,'order_last'=> $order_last], function($message) use ($order_last) {
            $message
                ->from(config('app.email'))
                ->to($order_last->email)
                ->subject('Замовлення №'.$order_last->id.' отримано, найближчим часом буде прийнято в роботу.');
            });
    }
    static public function orderBuyThanks($id) {
        $order = Order::where('id', $id)->first();
        return $order;
    }
    static public function banUser($phone,$email) {
        $ban_user = BanUser::where('phone',$phone)
            ->orWhere('email',$email)
            ->count();
        if($ban_user) {
            return 1;
        } else {
            return 0;
        }
    }
}

?>