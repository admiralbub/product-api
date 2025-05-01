<?php

namespace App\Http\Controllers\PbInstallment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\InstallmentsPrivatbankInterface;
use App\Models\Order;
use App\Interfaces\SalesdriverInterface;
class PbInstallmentCallbackController extends Controller
{
    public function __construct(
        public SalesdriverInterface $salesdriver,
        public InstallmentsPrivatbankInterface $installmentsPrivatbank
    )
    {
    }
    public function paymentinstallmentsCallback(Request $request) {
        $payinstallments = new PayinstallmentsClass();
        $pay = $this->installmentsPrivatbank->callbackOrder(request());
        $this->salesdriver->updateStatusCrm($pay['orderId'],$pay['status_rm']);
    }
}
