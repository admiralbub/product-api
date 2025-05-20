@php
    $deliverTypes = $delivers->pluck('type.value')->unique();
    $paymentTypes = $delivers->pluck('type.value')->unique();
@endphp
<x-layouts.app  
    :title="__('Placing an order')"
    :descriptions="''"
    :keywords="''"
    no_index=1>

    <x-block.hero :h1="__('Placing an order')" :breadcrumbs="$breadcrumbs"></x-x-block.hero>
    <div class="container mb-5 mt-5">

        <div class="row mt-5">
            <div class="col-12 col-lg-8">
                <div class="orders">
                    <form method="POST" role="form" action="{{route('order.post')}}" class="form">  
                        @csrf
                        <div class="form-block mb-7 ">
                            <div class="label d-flex mb-3 ">
                                <div class="label_item">
                                    <span>1</span>
                                </div>
                                <div class="label_item">
                                    <span>{{__('Your contact information')}}</span>
                                </div>
                            </div>
                            <div class="mt-4 row">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('lastName_title')}}  <span style="color:red; font-size: 14px;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" data-require="true" data-max="256" class="form-control" id="surname" name="last_name" value="{{auth()->check() ? auth()->user()->last_name : ''}}">
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('firstName_title')}}  <span style="color:red; font-size: 14px;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" data-require="true" data-max="256"  class="form-control" id="name" name="first_name" value="{{auth()->check() ? auth()->user()->first_name : ''}}">

                                </div>
                            </div>
                            <div class="mt-3 row">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('MiddleName_title')}} </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{auth()->check() ? auth()->user()->middle_name : ''}}">


                                </div>
                            </div>        
                            <div class="mt-3 row">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Phone_title')}} <span style="color:red; font-size: 14px;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="tel" data-require="true" data-max="256"  class="form-control tel" id="phone" name="phone" value="{{auth()->check() ? auth()->user()->phone : ''}}">


                                </div>
                            </div>  
                            <div class="mt-3 row">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Email')}} <span style="color:red; font-size: 14px;">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" data-require="true" data-max="256"  class="form-control" id="email" name="email" value="{{auth()->check() ? auth()->user()->email : ''}}">


                                </div>
                            </div>  
                            <div class="mt-3 row">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Promocode')}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="" name="promocode" value="">


                                </div>
                            </div> 
                            <div class="mt-3 row mb-3">
                                <label class="col-sm-3 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Notes to the order')}}</label>
                                <div class="col-sm-9">
                                    <textarea data-require="true" data-max="256"  class="form-control" name="notes_order" id="notes_order" rows="2"></textarea>
                                </div>
                            </div> 
                          
                           
                        </div>
                        
                        
                        <div class="form-block row mt-3 ">
                            <div class="label d-flex ">
                                <div class="label_item">
                                    <span>2</span>
                                </div>
                                <div class="label_item">
                                    <span>{{__('Deliver')}}</span>
                                </div>
                            </div>    
                            <div class="mt-3 row mb-3">
                                <label for="Deliver" class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Carrier')}}</label>
                                <div class="col-sm-8">
                                    <select class="form-select"  data-require="true" name="deliver" id="deliver">
                                        <option value="">---</option>
                                        @foreach($delivers as $deliver)
                                            <option value="{{$deliver->type->name}}">{{$deliver->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            @if($deliverTypes->intersect([1, 2])->isNotEmpty())
                                <div class="mt-3 row mb-3 d-none" id="np_city_block">
                                    <label for="Deliver" class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('City')}}</label>
                                    <div class="col-sm-8 position-relative">
                                        <input type="text" placeholder="{{__('Write and select a city')}}" class="form-control position-relative" id="np_city_input" name="city_np">
                                        <input type="text" id="city_ref_np" name="city_ref_np" hidden>
                                        <div class="close_input position-absolute" id="clear_city_np">&times;</div>
                                        <div class="resusltInput position-absolute bg-light py-3 px-2 z-3 d-none resusltCityNp">
                                            <ul id="resusltCityNp"></ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($deliverTypes->contains(1))
                                <div class="mt-3 row mb-3 d-none" id="np_warehouse_block">
                                    <label for="Deliver" class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Warehouse')}}</label>
                                    <div class="col-sm-8 position-relative">
                                        <input type="text" placeholder="{{__('All branches')}}" class="form-control" id="warehouse_input" name="warehouse_np" value="" readonly>
                                        <input type="text" id="warehouse_ref_np" name="warehouse_ref_np" value="" hidden>
                                        <div class="close_input position-absolute" id="clear_warehouse_np">&times;</div>
                                        <div class="resusltInput position-absolute bg-light py-3 px-2 z-3 d-none resusWarehouseNp">
                                            <ul id="resusltWarehouseNp"></ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($deliverTypes->contains(2))
                                <div class="mt-3 row mb-3 d-none" id="np_courier_warehouse_block">
                                    <label for="Deliver" class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Address')}}</label>
                                    <div class="col-sm-8 position-relative">
                                        <input type="text" placeholder="" class="form-control" id="np_courier_address" name="np_courier_address" value="">
                                    </div>
                                </div>
                            @endif

                            @if($deliverTypes->contains(4))
                                <div class="mt-3 row mb-3 d-none" id="np_self_address_block">
                                    <label for="Deliver" class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Address')}}</label>
                                    <div class="col-sm-8 position-relative">
                                        <input type="text" data-require="true" data-max="256" placeholder="" class="form-control" id="np_self_address_input" name="np_self_address" value="">
                                    </div>
                                </div>
                            @endif

                            @if($deliverTypes->contains(5))
                                <div class="mt-3 row mb-3 d-none" id="ukr_post_city_block">
                                    <label for="Deliver" class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Population point')}}</label>
                                    <div class="col-sm-8 position-relative">
                                        <input type="text" data-require="true" data-max="256" placeholder="" class="form-control" id="ukr_post_city" name="ukr_post_city" value="">
                                        <input type="text" id="ukr_post_id_city" name="ukr_post_id_city" value="" hidden>
                                        <div class="resusltInput position-absolute bg-light py-3 px-2 z-3 d-none resusltCityUkrPost">
                                            <ul id="resusltCityUkrPost"></ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 row mb-3 d-none" id="ukr_post_warehouse_block">
                                    <label for="Deliver" class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Warehouse')}}</label>
                                    <input type="text" id="ukr_post_id_warehouse" name="ukr_post_id_warehouse" value="" hidden>
                                    <div class="col-sm-8 position-relative">
                                        <input type="text" data-require="true" data-max="256" placeholder="" class="form-control" id="ukr_post_warehouse_input" name="ukr_post_warehouse" value="" readonly>
                                        <input type="text" id="ukr_post_post_code" name="ukr_post_post_code" value="" hidden>
                                        <div class="resusltInput position-absolute bg-light py-3 px-2 z-3 d-none resusWarehouseUkrPost">
                                            <ul id="resusltWarehouseUkrPost"></ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                           
                        </div>
                        <div class="form-block row mt-3 ">
                            <div class="label d-flex ">
                                <div class="label_item">
                                    <span>3</span>
                                </div>
                                <div class="label_item">
                                    <span>{{__('Payment')}}</span>
                                </div>
                            </div>    
                            <div class="mt-3 row mb-3">
                                <label for="Deliver" class="col-sm-4 col-form-label font-size-xs text-uppercase font-weight-medium text-dark text-ls mb-0">{{__('Payment method')}}</label>
                                <div class="col-sm-8">
                                    <select class="form-select" aria-label="Default select example" data-require="true" name="pay" id="pay_method">
                                        @foreach($payMethods as $payMethod)
                                            <option value="{{$payMethod->type->name}}">{{$payMethod->name}}</option>
                                        @endforeach
                                    
                                    </select>
                                </div>
                            </div>
                            @if($paymentTypes->contains(2))
                               
                                <div class="mt-3 row mb-3 d-none" id="privatbank_installment_block">
                                    <div class="d-flex align-items-center gap-3 p-3 border rounded">
                                        <!-- Иконка -->
                                        <div class="text-primary fs-4">
                                            <img src="{{asset('images/icon/paypart_big.webp')}}" alt="">
                                        </div>

                                        <!-- Название -->
                                        <div class="flex-grow-1">
                                            <strong>{{__('Payment by installments from PrivatBank')}}</strong>
                                        </div>

                                        <!-- Выпадающий список -->
                                        <div>
                                            <select class="form-select" id="count_payment_in_installments_pb" name="count_PP">
                                                <option value="2" data-tariff="2.8">2</option>
                                                <option value="3" data-tariff="3">3</option>
                                                <option value="4" data-tariff="4.1">4</option>
                                            </select>
                                        </div>
                                        <div>
                                            <span class="fw-bolder fs-5" id="totalBasketPbIntelPP"></span>
                                        </div>
                                        <!-- Чекбокс -->
                                        <div class="form-check ms-2">
                                            <input class="form-check-input" checked type="radio" name="credit_PP" id="installment_privatbank"  data-group="credit">
                                            <label class="form-check-label" for="flexCheckDefault"></label>
                                        </div>
                                    </div>
                                    <!-- Второй блок -->
                                    <div class="d-flex align-items-center gap-3 p-3 border rounded">
                                        <!-- Иконка -->
                                        <div class="text-primary fs-4">
                                            <img src="{{asset('images/icon/paypart_big.webp')}}" alt="">
                                        </div>

                                        <!-- Название -->
                                        <div class="flex-grow-1">
                                            <strong>{{__('Instant installment from PrivatBank')}}</strong>
                                        </div>

                                        <!-- Выпадающий список -->
                                        <div>
                                            <select class="form-select" id="count_instant_installment_pb" name="count_II">
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                        <div>
                                            <span class="fw-bolder fs-5" id="totalBasketPbIntellII">200</span>
                                        </div>
                                        <!-- Чекбокс -->
                                        <div class="form-check ms-2">
                                            <input class="form-check-input" type="radio" name="credit_II" id="instant_installment_privatbank"  data-group="credit">
                                            <label class="form-check-label" for="flexCheckDefault2"></label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($paymentTypes->contains(4))
                                <div class="mt-3 row mb-3 d-none" id="block_legal_acount">
                                    <div class="mb-5" style="position: relative;">
                                        <div class="form-group mb-3">
                                            <label class="fw-bolder pb-3">{{__('ЄДРПОУ')}}</label>
                                            <input type="text" class="form-control" id="edrpu_legal" name="edrpu_legal" >
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bolder pb-3">{{__('Full name of the legal entity')}}</label>
                                            <input type="text" class="form-control" id="full_name_legal" name="full_name_legal">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($paymentTypes->contains(5))
                                <div class="mt-3 row mb-3 d-none" id="block_individual_acount">
                                    <div class="mb-5" style="position: relative;">
                                        <div class="form-group mb-3">
                                            <label class="fw-bolder pb-3">{{__('full name')}}</label>
                                            <input type="text" class="form-control" id="fullName_acount" name="full_name_acount" >
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bolder pb-3">{{__('TIN')}}</label>
                                            <input type="text" class="form-control" id="tin_acount" name="tin_acount">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                        <div class="mt-4 d-md-flex justify-content-md-end">
                            <button  type="submit" class="btn btn-primary py-2 fw-bold btn-lg" >{{__('Placing an order')}}</button>
                
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                
                <div class="order_summ">
                   
                    <div class="order_summ-heading">
                        <span class="fs-2">{{__('Basket')}}</span>
                    </div>
                    
                    <ul class="order_summ-orders" id="showTableCart">
                       
                    </ul>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="label_goods">
                            <span class="label_goods_total">2</span> {{__('product(s)')}}
                        </div>
                        
                    </div>
                    <div class="order_summ-total pt-3">
                        <div class="label_goods d-flex justify-content-between">
                            <div class="label_goods-item">
                                <span>{{__('Conclusion')}}</span>
                            </div>
                            <div  class="label_goods-item" id="TotalBasketOrder">
                                <span>0.</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
               
            </div>
        </div>
    </div>
</x-layouts.app>