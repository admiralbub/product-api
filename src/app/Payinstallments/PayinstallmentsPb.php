<?php
namespace App\Payinstallments;


class PayinstallmentsPb {
       
       
    public static function callback($data) {
          
        preg_match('/<\?xml.*<\/payment>/', $data, $matches);
        $xmlData = $matches[0];
        $xml = simplexml_load_string($xmlData);
        $message = (string)$xml->message;
        $orderId = (string)$xml->orderId;
        $storeId = (string)$xml->storeId;
        $signature = (string)$xml->signature;
        $paymentState = (string)$xml->paymentState;
        $array_pay = [
            "message"=> $message,
            "orderId"=> $orderId,
            "storeId"=> $storeId,
            "signature"=> $signature,
            "paymentState"=> $paymentState,

        ];
        return  $array_pay;
    }
    public static function payinstall_create($payinparts,$product) {
           

        $products_string = "";
            

        foreach ($product as $item) {
            $nameProduct = $item["name"];
            $countProduct = $item["count"];
            $priceProduct = $item["price"];

            $products_string .= $nameProduct."".$countProduct."".number_format($priceProduct, 2, '', '');
        }

        $redirectUrl = $payinparts["redirectUrl"];
        $responseUrl = $payinparts["responseUrl"];
        $sign_string  =$payinparts['password']."".$payinparts['storeId']."".$payinparts["id_order"]."".number_format($payinparts["total"], 2, '', '').""
            .$payinparts['count_pay']."".$payinparts['merchantType']."".$responseUrl."".$redirectUrl."".$products_string."".$payinparts['password'];

        $signature = base64_encode( sha1( $sign_string,true) );

            
        $data1 = [
            "storeId" => "".$payinparts['storeId']."",
            "orderId" => "".$payinparts["id_order"]."",
            "amount" => $payinparts['total'],
            "partsCount" => $payinparts['count_pay'],
            "merchantType" => $payinparts['merchantType'],
            "products" =>  $product,
            "responseUrl" => $responseUrl,
            "redirectUrl" => $redirectUrl,
            "signature" => $signature
        ];
            
        $data1 = json_encode($data1, JSON_UNESCAPED_UNICODE);
            
        $curl = curl_init();
            
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://payparts2.privatbank.ua/ipp/v2/payment/create",// your preferred url
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLINFO_HEADER_OUT=>true,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_FAILONERROR =>true,
            CURLOPT_POSTFIELDS => $data1,
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "Content-type: application/json; charset=utf-8",
            ),
        ));
            
        $response = curl_exec($curl);
   
        $xml = simplexml_load_string($response);
        $token = (string)$xml->token;
        return  $token;
        curl_close($curl);
            
            
    }

    public static function decline($info) {
        $sign_string  =$info['password']."".$info['storeId']."".$info["id_order"]."".number_format($info["total"], 2, '', '')."".$info['password'];

        $signature = base64_encode( sha1( $sign_string,true) );

        $data1 = [
            "storeId" => "".$info['storeId']."",
            "orderId" => "".$info["id_order"]."",
            "amount" => $info['total'],
            "signature" => $signature
        ];
        $data1 = json_encode($data1, JSON_UNESCAPED_UNICODE);
            
        $curl = curl_init();
            
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://payparts2.privatbank.ua/ipp/v2/payment/decline",// your preferred url
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLINFO_HEADER_OUT=>true,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_FAILONERROR =>true,
            CURLOPT_POSTFIELDS => $data1,
            CURLOPT_HTTPHEADER => array(
                 // Set here requred headers
                "Content-type: application/json; charset=utf-8",
            ),
        ));
            
        $response = curl_exec($curl);
   
        $xml = simplexml_load_string($response);
        $state = (string)$xml->state;
        $storeId = (string)$xml->storeId;
        $orderId = (string)$xml->orderId;
        $signature = (string)$xml->signature;


        $array_decline = [
            "state"=> $state,
            "orderId"=> $orderId,
            "storeId"=> $storeId,
            "signature"=> $signature,
        ];
        return  $array_decline;

        curl_close($curl);

    }


    public static function payinstall_create_hold($payinparts,$product) {
        // ID заказ 434354985959589854 как тест

        $products_string = "";
        //$products_array = [$product["name"], $product["count"], number_format($product["price"], 2, '', '')];
         //$products_string = $product["name"]."".$product["count"]."".number_format($product["price"], 2, '', '');
        foreach ($product as $item) {
            $nameProduct = $item["name"];
            $countProduct = $item["count"];
            $priceProduct = $item["price"];

            $products_string .= $nameProduct."".$countProduct."".number_format($priceProduct, 2, '', '');
        }    
        $redirectUrl = $payinparts["redirectUrl"];
        $responseUrl = $payinparts["responseUrl"];
        $sign_string  =$payinparts['password']."".$payinparts['storeId']."".$payinparts["id_order"]."".number_format($payinparts["total"], 2, '', '').""
        .$payinparts['count_pay']."".$payinparts['merchantType']."".$responseUrl."".$redirectUrl."".$products_string."".$payinparts['password'];

        $signature = base64_encode( sha1( $sign_string,true) );

            
        $data1 = [
            "storeId" => "".$payinparts['storeId']."",
            "orderId" => "".$payinparts["id_order"]."",
            "amount" => $payinparts['total'],
            "partsCount" => $payinparts['count_pay'],
            "merchantType" => $payinparts['merchantType'],
            "products" => [
                $product
            ],
            "responseUrl" => $responseUrl,
            "redirectUrl" => $redirectUrl,
            "signature" => $signature
        ];
            
        $data1 = json_encode($data1, JSON_UNESCAPED_UNICODE);
            
        $curl = curl_init();
            
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://payparts2.privatbank.ua/ipp/v2/payment/hold",// your preferred url
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLINFO_HEADER_OUT=>true,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_FAILONERROR =>true,
            CURLOPT_POSTFIELDS => $data1,
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "Content-type: application/json; charset=utf-8",
            ),
        ));
            
        $response = curl_exec($curl);
   
        $xml = simplexml_load_string($response);
        $token = (string)$xml->token;
        return  $token;
        curl_close($curl);
            
            
    }

       
}
?>