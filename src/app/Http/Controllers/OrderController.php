<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\OrderInterface;
use App\Interfaces\SalesdriverInterface;
use App\Interfaces\BasketInterface;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OneClickRequest;
use Snowfire\Beautymail\Beautymail;
use App\Interfaces\DeliverInterface;
use App\Interfaces\PaymentMethodInterface;
use App\Interfaces\InstallmentsPrivatbankInterface;


class OrderController extends Controller
{

    public function __construct(
        public OrderInterface $order,
        public BasketInterface $basket,
        public SalesdriverInterface $salesdriver,
        public DeliverInterface $deliver,
        public PaymentMethodInterface $payMethod,
        public InstallmentsPrivatbankInterface $installmentsPrivatbank
    )
    {
    }
    public function __invoke() {
        if($this->basket->get_Count_Goods(auth()->check()) == 0) {
            abort(404);
        }
        $payMethods = $this->payMethod->getListPaymentMethod();
        $delivers = $this->deliver->getListDeliver();
        return view('cart.cart',['payMethods'=>$payMethods,'delivers'=>$delivers]);
    }

    public function store(OrderRequest $request) {

        

      //  dd($request);
        $isAuth = $this->basket->isAuth();
        $totalBasket = $this->basket->totalBasket($isAuth);
        $sendOrder = $this->order->getOrderAdd($request,$totalBasket);
        $isAuth = $this->basket->isAuth();
        if($isAuth) {
            $baskets = $this->basket->showBasketDb($isAuth);
        } else {
            $baskets = $this->basket->showBasketSession();
        }

        $addProductOrder = $this->order->getProductAdd($baskets,$sendOrder);
      //  $this->salesdriver->addOrderinCrm($sendOrder);
        $clearBasket = $this->basket->clearBasket($isAuth);
       

        $this->order->sendEmailOrder();
        if($request->pay =="INSTALLMENT_PRIVATBANK") {
            $token_pb = $this->installmentsPrivatbank->send($request,$sendOrder,$request->credit_PP ? "PP" : "II");
            return response()->json([
                'success'=>  __('You have successfully placed your order'),
                'redirect' => 'https://payparts2.privatbank.ua/ipp/v2/payment?token='. $token_pb
            ]);
        } else if($request->pay =="LIQPAY")  { 
            return response()->json([
                'success'=>  __('You have successfully placed your order'),
                'redirect' => route('liqpay.pay',$sendOrder)
            ]);
        } else {
            return response()->json([
                'success'=>  __('You have successfully placed your order'),
                'redirect' => route('profile.orders')
            ]);
        }
        
    }
    public function getOrder() {
        $orders = $this->order->showOrderAccount();
        //$delivers = $this->deliver->getListDeliver();


        return view('cabinet.orders',[
            'orders'=>$orders,
           // 'delivers'=>$delivers
        ]);
    }

    public function getOneClick(OneClickRequest $request, $id) {
        $setProductOneClick = $this->order->setProductOneClick($id);
        $showBasketOneClick = $this->basket->showBasketOneClick($setProductOneClick,$request->quantity);


        $addOneClickId = $this->order->getOneClickAdd($request,$showBasketOneClick->price);
        $addProcutOneClick = $this->order->getOneClickAddProduct($addOneClickId,$showBasketOneClick);


       
        return response()->json([
            'success'=>  __('You have successfully placed your order'),
            'redirect' => route('product.view',['slug'=>$request->slug])
        ]);

    }
}
