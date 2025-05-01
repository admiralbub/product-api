<?php

namespace App\Http\Controllers\Salesdriver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Interfaces\SalesdriverInterface;
class StatusCrmController extends Controller
{
   // public $salesdriver;
    public function __construct(
        public SalesdriverInterface $salesdriver
    )
    {
        //$this->salesdriver = $salesdriver;
    }
    public function __invoke(Request $request) {
        csrf_field();
        $data = json_encode($request->all()); 
        $this->salesdriver->updateStatusOrderCrm($data);
    }
}
