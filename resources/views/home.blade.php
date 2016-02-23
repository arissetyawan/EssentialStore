@extends('layouts.app')

@section('products')
<div class="container">
   
    <h1>Welcome to Pharmacy Online</h1>
    <p>Pharmacy Online takes the headache out of shopping for all of your discount pharmacy needs with online pharmacy shopping, massive discounts on over 12,000+ products and a retail shop presence offering everything from health, skin care, weight loss and everyones' favourite big-name shopping brands. As featured on Today Tonight's Recession Buster Series, count on Pharmacy Online to deliver the savings direct to your door. Shop with us today to enjoy our low prices and stay with us for the fast, friendly service!<p>
    <div class = "row">

        @foreach($products as $product)
         <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
            <div class="thumbnail">
             <a href= {{ "/buy/". $product->id }}> <img  src=  {{ URL::to('/'). "/images/products/" . $product->image}} class = "product_photo"></a>
              <p class = "text-center">${{$product->our_price}}</p>
              <div class="caption">
                <h4 class="text-center">{{$product->product_name}}</h4>
                
              </div>
          </div>
            
         </div> 
        @endforeach
    </div>
     <div class="text-center">
        {!! $products->links() !!}
  </div>
</div>
@stop
