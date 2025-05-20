<x-layouts.app  
    :title='__("thanks_order")." №".$order->id'
    descriptions=""
    keywords=""
    :no_index="true">

    <x-block.hero :h1='__("thanks_order")' :breadcrumbs="$breadcrumbs"></x-x-block.hero>
    <div class="container mt py-5 thanks">
		<ul class="thanks_pay">
			<li>{{__("number_order_thanks")}}: №{{$order->id}}.</li>
			<li>{{__("thanks_order_text")}}</li>
			<li><strong>{{__("summ_thanks_order_text")}}: {{$order->total}} UAH</strong></li>
		</ul>
        <div class="pt-2">
            <a href="{{route('index')}}">{{__('Home')}}</a>
        </div>
        
    </div>
</x-layouts.app>
