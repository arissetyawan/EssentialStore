@extends('layouts.app')
@section('content')

<div class="container">

	<h2>{{$product->product_name}}</h2>
	<div class= "row">
		<div class = "col-md-6">
			<div class = "row">
				<div class = "col-md-6">
					<img src= {{ URL::to('/'). "/images/products/" . $product->image}} alt = "..." width="200px" height="200px">
					
					
					
				</div>
				<div class="col-md-6"> 
				
					<h1 style="margin:0">$ {{$product->our_price}}</h1>
					<h2 style="margin:0; color:red;" class="red"> Save $ {{$product->market_price - $product->our_price}}</h2>
					<h3 style=" color: gray"> Don't pay RRP {{$product->market_price}}</h3>
					<div class="row">
						<div class="col-md-4">
							
							  <select class="form-control quantityProductDetail" id="sel1" style="margin-top:10px">
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
						</div>
						<div class="col-md-8">
							<form  id ="addToCardForm" method="POST" action={{ url('yourShoppingCart/'.$product->id) }} >
								{{ csrf_field() }}
								<div class="form-group">
									<button type="button" class ="btn btn-lg btn-primary addToCart_btn" >
										<i class="fa fa-shopping-cart">  ADD TO CART</i>  
										 	
									</button>
								</div>
							</form>
						</div>
					</div>

				</div>

				
			</div>

		</div>
	</div>
	<div class="row" style="margin-top:40px">
		<div class="col-md-6">
			<div class="form-group">
  				  <div class="product_description" style="height:200px; overflow:auto; border: 1px solid rgb(221, 221, 221); padding:10px;"></div>
  				  	
  				  </textarea>
  				  <div class="dummy hidden">{{$product->product_description}}</div
			</div>
		</div>					

	</div>
	
</div>
@stop