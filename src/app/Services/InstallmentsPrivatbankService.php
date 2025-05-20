<?php
namespace App\Services;
 
use App\Interfaces\InstallmentsPrivatbankInterface;
use App\Payinstallments\PayinstallmentsPb;
use App\Models\Order;
use App\Log\DailyLogger;
class InstallmentsPrivatbankService implements InstallmentsPrivatbankInterface {
    public function send($request,$order_id, $installment_type) {
        $order = Order::findOrFail($order_id);
        foreach ($order->products as $product) {
           
            if($installment_type == "II") {
                $price = intval($product->pivot->price / $product->pivot->quantity) + (intval($product->pivot->price / $product->pivot->quantity)* (1.3 / 100));
                $product_pay[] = [
                    'name' => $product->name_ua,
                    'count' => $product->pivot->quantity,
                    'price' => number_format($price, 2, '.', ''),
                
                ];
                
            } else {
                $price = intval($product->pivot->price / $product->pivot->quantity) + (intval($product->pivot->price / $product->pivot->quantity)* ($request->tarrif_installment / 100));
                $product_pay[] = [
                    'name' => $product->name_ua,
                    'count' => $product->pivot->quantity,
                    'price' => number_format($price, 2, '.', ''),
                
                ];
            }
            
        }
      //  dd($product_pay);
        $total = 0;
        if($installment_type == "II") {
            $total = $order->total + ($order->total * (1.3 / 100)); 
        } else {
            $total = $order->total + ($order->total * ($request->tarrif_installment/ 100)); 
        }
    
        $pay_in_parts = [
            "id_order"=>$order->id,
            "total"=>number_format($total, 2, '.', ''),
            "count_pay"=>$request->credit_PP ? $request->count_PP : $request->count_II,
            "merchantType"=>$installment_type,
            "redirectUrl"=>route('thanks.buy',$order->id),
            "responseUrl" =>route("paymentinstallmentsCallback"),
            "password"=>payment_providers('store_id_installment_privatbank'),
            "storeId"=>payment_providers('password_installment_privatbank')
        ];
        /*
        $log = new DailyLogger(
            mb_convert_encoding(json_encode($log, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'UTF-8'),
            "/var/www/html/public/log/pb_installment/pb_api",
            "api"

        );
        $log->log();*/
        $log = [
            $pay_in_parts,
            $product_pay
        ];
        $log = new DailyLogger(
            mb_convert_encoding(json_encode($log, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'UTF-8'),
            storage_path('log/installments_pb/installments_pb_api'),
            "api"
        );
        $log->log();


        $payinstallments = new PayinstallmentsPb();
        $token = $payinstallments->payinstall_create($pay_in_parts,$product_pay);
        return $token;
    }
    public function callbackOrder($request) {
        $log = new DailyLogger(
            mb_convert_encoding(json_encode($request, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'UTF-8'),
            storage_path('log/installments_pb/installments_pb_callback'),
            "api"
        );
        $log->log();

        $payinstallments = new PayinstallmentsPb();
        $data = $payinstallments->callback($request);
        if ($data["paymentState"] === 'SUCCESS') {
            $order = Order::where("id",$data['orderId'])
                ->update([
                    "status"=>"credit",
                   // "loan_agreement"=>$data["message"],
                    //"is_paymentinstallments"=>true,
                    //"is_payed"=>1
                ]);
        }
        return [
            "orderId"=>$data["orderId"],
            "status_rm"=>"273",
        ];
    }
  

}