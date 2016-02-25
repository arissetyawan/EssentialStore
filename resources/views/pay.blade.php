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

	<form action="/checkout" method="POST">
		{{ csrf_field() }}
	  <script
	    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
	    data-key="pk_test_9AQOh2FS34hP8BEZEU91jt64"
	    data-image="/img/documentation/checkout/marketplace.png"
	    data-name="Demo Site"
	    data-description="2 widgets"
	    data-currency="aud"
	    data-amount="4000"
	    data-locale="auto">
	  </script>
	  <input type="hidden" name = "amount" value="4000" />
</form>
	</div>
@stop