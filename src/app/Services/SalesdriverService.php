<?php
namespace App\Services;
 
use App\Interfaces\SalesdriverInterface;
use App\Jobs\SendToSalesDrive;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Enums\OrderStatus;
class SalesdriverService implements SalesdriverInterface {
    public function addOrderinCrm($orderId) {
        $order = Order::findOrFail($orderId);
       // dd($order->first_name);
        $deliver_branch = json_decode($order->delivery, true);
        $pay_data = json_decode($order->pay_info, true);
        $isNP = strpos($deliver_branch['deliver'], 'NP') !== false;
        $salesDriveProducts = [];
        foreach ($order->products as $product) {
            $salesDriveProducts[] = [
                'id' => $product->id,
                'name' => $product->name,
                'costPerItem' => intval($product->pivot->price / $product->pivot->quantity),
                'amount' => $product->pivot->quantity,
            ];
        }
     
        $pay_salesdriver = match ($pay_data['pay_title']) {
            'RECEIPT_OF_GOODS' => 'postpay',
            'INSTALLMENT_PRIVATBANK' => 'postpay',
            'LIQPAY' => 'postpay',
        };

        SendToSalesDrive::dispatch('handler/', [
            "form" => "qleqMom3C0wiuOHs6YpcjOmxMQ54x5Getl6URoDM2JWZqodSlVkxvy6Oc0NKc9Vk_ptuY1NdQ",
            "fName" => $order->first_name,
            "lName" => $order->last_name,
            "mName" =>  $order->middle_name ?? "",
            "phone" => $order->phone ?? '',
            "email" => $order->email ?? '',
            "externalId"=>$order->id,
            "comment" => $order->comment ?? '',
            "products" => $salesDriveProducts,
            "shipping_method" => $isNP ? 'Нова пошта' : '',
            "payment_method" => $pay_salesdriver,
            "novaposhta" => [
                "city" => $deliver_branch['city_ref'],
                "ServiceType" => $isNP ? ($deliver_branch['deliver'] === 'NP' ? 'DoorsWarehouse' : 'DoorsDoors') : '',
                "WarehouseNumber" => $deliver_branch['warehouse_ref'],

                "StreetRef" => "",
                "BuildingNumber" => "",
                "Flat" => "",
                "backwardDeliveryCargoType" => "",
                "paymentForm" => ""
            ],
           // "products" => $salesDriveProducts,

        ]);
    }
    public function exportProductSalesdriver() : Array {
        $feedHtml ="";
        $products =  Product::with(['categories', 'brand'])
            ->available()
            ->get();

        $products_category = Category::published()->get();
        

        //cache()->put(self::CACHE_KEY, $feedHtml, now()->addHours(3));
        
        return [
            'products'=>$products,
            'products_category'=>$products_category
        ];
        
    }
    public function updateStatusOrderCrm($data) {
        $crm_result = array();   
        $params_crm = json_decode($data, true);
        foreach ($params_crm as $key => $value){
            $crm_result[] = $value;
        }
        if(!empty($crm_result[1]['externalId'])) {
            $status="";
            $ready_status = 0;
            if (in_array($crm_result[1]['statusId'], [313])) {
                $status=OrderStatus::EXPECT;
            } else if (in_array($crm_result[1]['statusId'], [314,315,322])) {
                $status=OrderStatus::WORK; 
            } else if (in_array($crm_result[1]['statusId'], [324,9,329,330,325])) {
                $status=OrderStatus::PAY;     
            } else if (in_array($crm_result[1]['statusId'], [317,331,327,326])) {
                $status=OrderStatus::PAID;      
            } else if (in_array($crm_result[1]['statusId'], [316,5,328])) {
                $status=OrderStatus::SEND;      
                $ready_status = 1;      
            } else if (in_array($crm_result[1]['statusId'], [318,320,319,332])) {
                $status=OrderStatus::CANCEL;     
            }  else if (in_array($crm_result[1]['statusId'], [273])) {
                $status=OrderStatus::CREDIT;     
            } 


           /* if($ready_status == 1) {
                sentMailFeedback($crm_result[1]['externalId']);
            }*/
            Order::where([
                'id'=>$crm_result[1]['externalId']
            ])->update(array('status' => $status));
        }
    }
    public function updateStatusCrm($orderId, $statusId) {
        SendToSalesDrive::dispatch('api/order/update/', [
            "form" => "DW43O83k-gOubhpGgEjb_CJn2V-kwJyscyHy_J9pp0D9KoDi3Z-eh4CwFi1gp",
            "externalId" =>intval($orderId),
            "data" => [
                "statusId" => $statusId,
            ],
            "prodex24source_full" => $_COOKIE["prodex24source_full"] ?? '',
            "prodex24source" => $_COOKIE["prodex24source"] ?? '',
            "prodex24medium" => $_COOKIE["prodex24medium"] ?? '',
            "prodex24campaign" => $_COOKIE["prodex24campaign"] ?? '',
            "prodex24campaign_id" => $_COOKIE["prodex24campaign_id"] ?? '',
            "prodex24page" => $_SERVER["HTTP_REFERER"] ?? '',
        ]);
    }

}

?>