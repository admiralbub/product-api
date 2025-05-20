<?php
namespace App\LiqPay;
use App\Models\Order;
use App\Log\DailyLogger;
class LiqpayManagement {
    public  function LiqPay_data($order_id) {
        $order = Order::findOrFail($order_id);
        $data_arr  = array(
            'public_key' => "".payment_providers('public_key_liqpay')."", 
            'version' => "3", 
            'action' => "pay", 
            'amount' => $order->total, 
            'currency' => "UAH", 
            'description' => "Сплата за  замовлення  №".$order_id, 
            'order_id' => $order_id,
            'result_url'=>route('thanks.buy',$order_id), 
            'server_url'=> route('liqpay.callback_liqpay',$order_id)
        );
        $log = new DailyLogger(
            mb_convert_encoding(json_encode($data_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'UTF-8'),
            storage_path('log/liqpay/liqpay_api'),
            "api"

        );
        $log->log();


        $data = base64_encode(json_encode($data_arr));
        return  $data;
    }

    public function LiqPay_signature($id, $data) {
        $sign_string  =payment_providers('private_key_liqpay').$data.payment_providers('private_key_liqpay');

        $signature = base64_encode( sha1( $sign_string,true) );
        return  $signature;
    }
    public function callback_liqPay($id,$data) {
        
        $log = new DailyLogger( 
            mb_convert_encoding(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), 'UTF-8'),
            storage_path('log/liqpay/liqpay_callback'),
            "api"

        );
        $log->log();

        $params = json_decode(base64_decode($data), true);
        $sign_string  =payment_providers('private_key_liqpay').$data.payment_providers('private_key_liqpay');
        $signatureAuthentic=base64_encode(sha1( $sign_string,true));
        if (request()->signature !== $signatureAuthentic) {
            return 0;
        }

        $status = $params['status'] ?? 'error';
        if ($status === 'success') {
            $order = Order::findOrFail(intval($params['order_id']));
            $order->is_payed = true;
            $order->pay_type = 'liqpay';
            $order->status = 'pay';
            $order->pay_amount = $params['amount'];

            $order->save();
        }
        return 1;

    }
}   

?>