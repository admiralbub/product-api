<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\OrderInterface;
//use App\Interfaces\SalesdriverInterface;
use App\Interfaces\BasketInterface;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OneClickRequest;
use Snowfire\Beautymail\Beautymail;
use App\Interfaces\DeliverInterface;
use App\Interfaces\PaymentMethodInterface;
use App\Interfaces\InstallmentsPrivatbankInterface;
use App\Interfaces\TelegramNotificationInterface;
use App\Interfaces\PromoCodeInterface;
use App\Breadcrumbs\Breadcrumb;
class OrderController extends Controller
{

    public function __construct(
        public OrderInterface $order,
        public BasketInterface $basket,
       // public SalesdriverInterface $salesdriver,
        public DeliverInterface $deliver,
        public PaymentMethodInterface $payMethod,
        public InstallmentsPrivatbankInterface $installmentsPrivatbank,
        public TelegramNotificationInterface $telegramNotification,
        public PromoCodeInterface $promocode,
        public Breadcrumb $breadcrumbs
    )
    {
    }
    public function __invoke() {
        if($this->basket->get_Count_Goods(auth()->check()) == 0) {
            abort(404);
        }
        $bread = [
            "name"=>__("Order"),
            "route"=>"order.index"
        ];

        $breadcrumbs = $this->breadcrumbs->breadPage($bread);
        $payMethods = $this->payMethod->getListPaymentMethod();
        $delivers = $this->deliver->getListDeliver();
        return view('cart.cart',['payMethods'=>$payMethods,'delivers'=>$delivers,'breadcrumbs'=>$breadcrumbs]);
    }

    public function store(OrderRequest $request) {


        if($this->order->banUser($request->phone, $request->email)) {
            return response()->json([
                'error' => __('Unfortunately you are unable to fulfill the order. Please contact the site administrator.')
            ]);
        }
      //  dd($request);
        $isAuth = $this->basket->isAuth();
        $totalBasket = $this->basket->totalBasket($isAuth);
        $total_promocode = 0;
        if (isset($request->promocode)) {
            if($this->promocode->getPromocodeValidation($request->promocode,$totalBasket)) {
                $total_promocode = $this->promocode->getTotalPromocode($request->promocode,$totalBasket);
            } else {
                return response()->json([
                    'error'=>  __('Unfortunately you entered the wrong promo code'),
                    //'redirect' => route('order.index')
                ]);
            }
        }
        


        $sendOrder = $this->order->getOrderAdd($request,$totalBasket,$total_promocode);
        $isAuth = $this->basket->isAuth();
        if($isAuth) {
            $baskets = $this->basket->showBasketDb($isAuth);
        } else {
            $baskets = $this->basket->showBasketSession();
        }

        

        $addProductOrder = $this->order->getProductAdd($baskets,$sendOrder);
      //  $this->salesdriver->addOrderinCrm($sendOrder);
        $this->telegramNotification->sendTelegramNotificationToAdminChannel("Заказ через корзину.", $sendOrder);
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
                'redirect' => route('thanks.buy',$sendOrder)
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
        
        $this->telegramNotification->sendTelegramNotificationToAdminChannel("Заказ через 1 клик.", $addOneClickId);
        return response()->json([
            'success'=>  __('You have successfully placed your order'),
            'redirect' => route('thanks.buy',$addOneClickId)
        ]);

    }
}
