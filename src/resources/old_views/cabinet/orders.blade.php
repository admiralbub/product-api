
<x-layouts.app  
    :title="__('My order')"
    :descriptions="__('My order')"
    :keywords="__('My order')"
    no_index=1>

    <div class="account container py-5">
        <div class="row">
            <div class="col-lg-3">
                <x-cabinet.menu/>
            </div>
            <div class="col-lg-9">
                <div class="account_heading">
                    <h1 class="fs-4">{{__('My order')}}</h1>    
                </div>
                @if(count($orders)>0)
                    @foreach($orders as $order)
                        <div class="accordion mt-3" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button position-relative" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapseOne">
                                      
                                    @if($order->status->isExpect())
                                    
                                            <div class="status_deliver default"></div>
                                        @elseif($order->status->isWork())
                                    
                                            <div class="status_deliver work"></div>

                                        @elseif($order->status->isPay())
                                    
                                            <div class="status_deliver to_pay"></div>

                                        @elseif($order->status->isPaid())
                                    
                                            <div class="status_deliver success_pay"></div>

                                        @elseif($order->status->isSend())
                                    
                                            <div class="status_deliver success"></div>

                                        @elseif($order->status->isCancel())
                                    
                                            <div class="status_deliver cancel"></div>
                                        @endif
                                        
                                        <div class="d-flex">
                                            <div class="px-4">
                                                <span>
                                                    <strong>№ {{$order->id}}</strong> {{__('from')}} {{$order->created_at}}
                                                </span>
                                                <div class="pt-2">
                                                    {{$order->status->getDescription()}}
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </button>
                                </h2>
                                <div id="collapse{{$order->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row py-3 px-2">
                                            <div class="col-lg-5 pt-2">
                                                <div class="pb-2">
                                                    <span class="text-uppercase">{{__('Info deliver')}}</span>
                                                    <div class="pt-2">
                                                        <span class="fs-6">
                                                            @if($order->deliver_type)
                                                                @if($order->deliver_type==\App\Enums\TypeDeliver::NP->name)
                                                                    {{$order->deliver_name}} {{$order->np_city}} {{$order->np_warehouse}}
                                                                @elseif($order->deliver_type==\App\Enums\TypeDeliver::NP_COURIER->name)
                                                                    {{$order->deliver_name}} {{$order->np_city}} {{$order->np_courier_address}}
                                                                @elseif($order->deliver_type==\App\Enums\TypeDeliver::SELF_DELIVERY->name)
                                                                    {{$order->deliver_name}} {{$order->np_self_address}}
                                                                @elseif($order->deliver_type==\App\Enums\TypeDeliver::WAREHOUSE_REMOVAL->name)
                                                                    {{$order->deliver_name}}
                                                                @elseif($order->deliver_type==\App\Enums\TypeDeliver::UKRPOSHTA->name)
                                                                    {{$order->deliver_name}}  {{$order->ukr_post_city}} {{$order->ukr_post_warehouse}} 
                                                                @endif
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="pt-3">
                                                    <span class="text-uppercase">{{__('Payment')}}</span>
                                                    <div class="pt-2">
                                                        <span class="fs-6">
                                                            @if($order->pay_type)
                                                                {{$order->pay_name}}
                                                            @endif
                                                           
                                                        </span>
                                                    </div>
                                                    @if($order->pay_type==\App\Enums\TypePaymentMethod::INSTALLMENT_PRIVATBANK->name)
                                                        <div class="pt-2">
                                                            <span class="fs-6">
                                                                {{__('Number of payments')}}: {{$order->credit_count}}
                                                            
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if($order->pay_type==\App\Enums\TypePaymentMethod::INSTALLMENT_PRIVATBANK->name)
                                                        <div class="pt-2">
                                                            <span class="fs-6">
                                                                {{__('Type credit')}} 
                                                                @if($order->type_installment == "II")
                                                                    {{__('Instant installment from PrivatBank')}} 
                                                                @elseif ($order->type_installment == "PP")
                                                                    {{__('Payment by installments from PrivatBank')}} 
                                                                @endif
                                                            
                                                            </span>
                                                        </div>
                                                    @endif

                                                    @if($order->pay_type==\App\Enums\TypePaymentMethod::LIQPAY->name)
                                                        <div class="pt-2">
                                                            <span class="fs-6">
                                                                {{__('total pay')}}: {{$order->pay_amount ?? 0}} грн.
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if($order->pay_type==\App\Enums\TypePaymentMethod::LEGAL_ACCOUNT_CURRENT->name)
                                                        <div class="pt-2">
                                                            <span class="fs-6">
                                                                {{__('ЄДРПОУ')}}: {{$order->edrpu_legal ?? 0}}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if($order->pay_type==\App\Enums\TypePaymentMethod::LEGAL_ACCOUNT_CURRENT->name)
                                                        <div class="pt-2">
                                                            <span class="fs-6">
                                                                {{__('Full name of the legal entity')}}: {{$order->full_name_legal ?? 0}}
                                                            </span>
                                                        </div>
                                                    @endif


                                                    @if($order->pay_type==\App\Enums\TypePaymentMethod::INDIVIDUALS_ACCOUNT_CURRENT->name)
                                                        <div class="pt-2">
                                                            <span class="fs-6">
                                                                {{__('full name')}}: {{$order->full_name_acount ?? 0}}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if($order->pay_type==\App\Enums\TypePaymentMethod::INDIVIDUALS_ACCOUNT_CURRENT->name)
                                                        <div class="pt-2">
                                                            <span class="fs-6">
                                                                {{__('TIN')}}: {{$order->tin_acount ?? 0}}
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="pt-3">
                                                    <span class="text-uppercase">{{__('total')}}</span>
                                                    <div class="pt-2">
                                                        <span class="fs-5 fw-semibold">{{$order->total}} {{__("uah")}}</span>
                                                    </div>
                                                </div>
                                                @if($order->promocode)
                                                    <div class="pt-1">
                                                    
                                                        <div class="pt-2">
                                                            <span>{{__('Promocode')}}</span>
                                                            <span>{{$order->promocode->code}}</span>
                                                        </div>
                                                        <div class="pt-2">
                                                            <span class="d-none">{{__('Type promocode')}}</span>
                                                            <span>{{$order->promocode->promocode_name}}</span>
                                                        </div>
                                                        @if($order->promocode->type_promocode == \App\Enums\TypePromocode::FIXED_PRICE->value || $order->promocode->type_promocode == \App\Enums\TypePromocode::PERCENTAGE_DISCOUNT->value)
                                                            <div class="pt-2">
                                                                <span class="text-uppercase">{{__('Total with Promocode')}}:</span>
                                                                <span class="fs-5 fw-semibold">{{$order->total_promocode}} {{__("uah")}}</span>
                                                            </div>
                                                        @endif
                                                        @if($order->promocode->type_promocode == \App\Enums\TypePromocode::GIFT_PRODUCT->value)
                                                            <div class="pt-2">
                                                                <span class="text-uppercase">{{__('Gift')}}:</span>
                                                                <span>
                                                                    <a href="{{route('product.view',$order->promocode->product->slug)}}" class="text-dark">{{$order->promocode->product->name}}</a>
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                                
                                            </div>
                                            <div class="col col-lg-7">
                                                <div class="table-orderAccount">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"></th>
                                                                <th scope="col">{{__('Goods')}}</th>
                                                                <th scope="col">{{__('Pack')}}</th>
                                                                <th scope="col">{{__('Price')}}</th>
                                                                <th scope="col">{{__('Quantity')}}</th>
                                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->products as $product)
                                                                <tr>
                                                                    <td class="image">
                                                                        <img src="{{asset($product->image)}}" alt=""  class="image" >
                                                                    </td>
                                                                    <td class="name_product">
                                                                        <a href="{{route('product.view',['slug'=>$product->slug])}}">{{$product->name}}</a>
                                                                    </td>
                                                                    <td class="pack_name text-nowrap">{{$product->packs()->first()->name}}</td>
                                                                    <td>
                                                                        <div class="history_orders text-nowrap">
                                                                            {{$product->pivot->price}} 
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="count_orders">
                                                                            {{$product->pivot->quantity}}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="pt-3">
                        <p class="fs-5">{{__('You have no orders')}}</p>
                    </div>
                    
                @endif
            </div>
        </div>
    </div>
    
</x-layouts.app>
