@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart', ['color' => '#5A6C56'])

		<h4 class="secondary"><strong>Добрий день, {{$name}} </strong></h4>
		<p> Ми помітили, що ви додали деякі товари до свого кошика, але ще не здійснили покупку.</p>
        <p>Не забувайте, що це ваша унікальна можливість придбати обрані товари! </p>
            
		<p>Нагадуємо вам про товари, які залишилися в вашому кошику:</p>

		<table width="100%" style="color:#888888">
			<tr>
				<th align="center">Назва товару</th>
				<th align="center">Кіл.</th>
				<th align="center">Тара.</th>
				<th align="center">Ціна.</th>
				
			</tr>


			@foreach($list_baskets as $product)
				<tr>
					
					<td align="center" height="25" ><a href="growex.market/product/{{$product->slug}}">{{$product->name_ua}}</a></td>
					<td align="center" height="25">{{$product->quantity}}</td>
					<td align="center" height="25">{{$product->pack_name}}</td>
					<td align="center" height="25">{{$product->price}} грн</td>

				</tr>
			@endforeach
			
		</table>
		<p>Завітайте на наш веб-сайт та завершіть процес замовлення.</p>
		<p>Зробіть замовлення <a href="{{route('order.index')}}">за посиланням</a></p>

		<br>
		
	@include('beautymail::templates.widgets.articleEnd')


@stop