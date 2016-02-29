@extends('manage')
@section('content')
	<div class="container">
    @include('common.errors')
		<form action={{ url('create') }} method = "POST" enctype="multipart/form-data">
      {{ csrf_field() }}
          <div class="form-group">
            <label for="product-name" class="control-label">Product name</label>
            <input type="text" class="form-control" id="product-name" name="product_name">
            </div>
          <div class="form-group">
            <label for="product-description" class="control-label">Product description</label>
            <textarea class="form-control" id="product-description" name = "product_description"></textarea>
          </div>
          <div class="form-group">
            <label for="category" class="control-label">Category</label>
             <select class="form-control category" id="product_category" name = "category_id"  style="width:200px" >
                 @foreach ($categories as $cateogry)
                  <option  value = {{$cateogry->id}}>{{$cateogry->category_name}}</option>
                @endforeach
                </select>
          </div>

          <div class="form-group">
            <label for="our-price" class="control-label">Our Price</label>
            <input type = "text" class="form-control" id="our-price" name ="our_price"></textarea>
          </div>
          <div class="form-group">
            <label for="market-price" class="control-label">Market Price</label>
            <input type = "text" class="form-control" id="market-price" name = "market_price"></textarea>
          </div>
          <div class="form-group">
            <label for="amount" class="control-label">Amount</label>
            <input type = "text" class="form-control" id="amount" name = "amount"></textarea>
          </div>
          <div class="form-group">
            <label for="product-photo" class="control-label">Product Photo</label>
            <input type = "file" class="form-control" id="product-photo" name = "product_photo"></textarea>
          </div>
          <div class="form-group">
          	<button type= "submit" class= "btn btn-lg btn-primary">Create</button>
          </div>
        </form>
	</div>
@stop