@extends('layouts.app')

@section('products')
<div class="container">
	<form method="POST" id = "changeQuantity" action={{ url('shoppingCartChanged') }} >
				{{ csrf_field() }}
               
</form>
	<form  id ="removeItem" action={{ url('yourShoppingCart/delete') }} method="POST" class="hidden">
		{{ csrf_field() }}
        {!! method_field('DELETE') !!}
	</form>
	 <table class="table">
 		 	<tr>
 		 		<th>Product</th>
 		 		<th>Quantity</th>
       			 <th>Unit Price</th>
 		 		<th>Subtotal</th>
 		 	
 		 	</tr>	
 		<p class="hidden"> {{$total = 0}}	</p>
		@foreach($orders as $order)
		<p class="hidden">{{ $total += $order['subtotal']}}</p>
			<tr>
				<td>
					
					<i class="fa fa-trash-o remove_item_icon" product_id={{$order['product_id']}} style="font-size: 1.5em;
color: rgba(255, 145, 110, 0.55);"></i>
					
					<img src= {{ URL::to('/'). "/images/products/" . $order['product_image']}} alt = "..." width="80px" height="80px">
					<span>{{$order['product_name']}}</span>
				</td>
				<td>

					<p class="hidden">{{$order['quantity']}}</p>
					<select class="form-control quantityCart" product_id = {{$order['product_id']}}>
							    <option value = 1>1</option>
							    <option value = 2>2</option>
							    <option value = 3>3</option>
							    <option value = 4>4</option>
							    <option value = 5>5</option>
							    <option value = 6>6</option>
							    <option value = 7>7</option>
							    <option value = 8>8</option>
							    <option value = 9>9</option>
							    <option value = 10>10</option>
							    <option value = 11>11</option>
							    <option value = 12>12</option>
							    <option value = 13>13</option>
							    <option value = 14>14</option>
							    <option value = 15>15</option>
							    <option value = 16>16</option>
							    <option value = 17>17</option>
							    <option value = 18>18</option>
							    <option value = 19>19</option>
							    <option value = 20>20</option>
					</select>
				</td>
			
				<td>{{$order['product_price']}}</td>
				<td>{{$order['subtotal']}}</td>
				

			</tr>
		@endforeach
		
		
	</table>
		<a href="{{ URL::to('/')}}" class="btn btn-default btn-primary text-uppercase pull-left"><i class="fa fa-shopping-cart"></i> Continue Shopping</a>
	<div class= "row">
		<div class="col-md-4 pull-right">	
			<table class="table text-right pull-right">
				<tr>
					<td>Sub-total:</td>
					<td>{{$total}}</td>
				</tr>
				<tr>
						<td>Standard shipping to:</td>
						<td>{{0}}</td>
				</tr>
				<tr>
						<td>Total</td>
						<td>{{$total}}</td>
				</tr>

			</table>
			<form method= "POST" action = {{ url('ePay'). '?amount=' . $total  }} id = "ePayForm">
				
				<button  type ="submit" id = "ePayBtn" class="btn btn-lg text-uppercase btn-success pull-right"><i class="fa fa-credit-card" style="font-size:1.2em"></i>  Check out</button>	
			</form>
		</div>
	</div>	
</div>
@stop