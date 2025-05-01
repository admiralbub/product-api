<?php

namespace App\Http\Controllers\Liqpay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\SalesdriverInterface;
use App\LiqPay\LiqpayManagement;
class LiqpayController extends Controller
{
    public function __construct(public SalesdriverInterface $salesdriver) {

    }
    public function pay($id)
    {
        $liqpay = new LiqpayManagement();
        $data = $liqpay->LiqPay_data($id);
      
        $signature = $liqpay->LiqPay_signature($id, $data);

        return redirect('https://www.liqpay.ua/api/3/checkout?data='.$data.'&signature='.$signature.'');
    }
    public function callback_liqpay($id) {
        $liqpay = new LiqpayManagement();
        $status = $liqpay->callback_liqPay($id, request()->data);
        if($status == 0) {
            abort(401);
        }
        if($status == 1) {
            $this->salesdriver->updateStatusCrm($id,"3");
        }
        return ["OK"];
    }
}
