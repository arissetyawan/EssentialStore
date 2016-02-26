@extends('layouts.app')

@section('content')
	<div class="container">
    <!--		
	<form action="/checkout" method="post" id="checkout">	
		 {!! csrf_field() !!}
		<script src="https://checkout.stripe.com/checkout.js"></script>

		<button id="customButton">Purchase</button>

		<input type = "hidden" name ="amount" value = "5000"/>

	
	</form> -->
	<p class="hidden" {{$total = 0}}></p>
	@foreach($orders as $order)
		<p class="hidden">{{ $total += $order['subtotal']}}</p>

	@endforeach	
	<form action="/checkout" method="POST">
		{{ csrf_field() }}
	  <script
	    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
	    data-key="pk_test_9AQOh2FS34hP8BEZEU91jt64"
	    data-image="/img/documentation/checkout/marketplace.png"
	    data-name="Demo Site"
	    data-description="2 widgets"
	    data-currency="aud"
	    data-amount={{$total *100}}
	    data-locale="auto">
	  </script>
	  <input type="hidden" name = "amount" value={{$total*100}} />
</form>

	<!-- paypal -->
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="upload" value="1"> 
	<input type ="hidden" name="business" value="brian.pham.adelaideuni-facilitator@gmail.com">
	

	<input type ="hidden" {{$item_num = 0}}>
	
	@foreach ($orders as $order	)

		<input type="hidden" {{$item_num++}}>
		<input type= "hidden" name={{"item_name_" . $item_num}} value = {{$order['product_name']}}>
		<input type ="hidden" name = {{"amount_" . $item_num}} value = {{$order['product_price']}} >
		<input type = "hidden" name = {{"quantity_" .$item_num }} value= {{$order['quantity']}}>
		<input type ="hidden" name = {{"shipping_" . $item_num}} value = "0.00" >
	@endforeach	



	<input type="submit" value="PayPal">
	</form>




	</div>
@stop