@extends('layouts.app')

@section('products')
<div class="container">
   
    <h1>Welcome to Pharmacy Online</h1>
    <p>Pharmacy Online takes the headache out of shopping for all of your discount pharmacy needs with online pharmacy shopping, massive discounts on over 12,000+ products and a retail shop presence offering everything from health, skin care, weight loss and everyones' favourite big-name shopping brands. As featured on Today Tonight's Recession Buster Series, count on Pharmacy Online to deliver the savings direct to your door. Shop with us today to enjoy our low prices and stay with us for the fast, friendly service!<p>
    <div class = "row">
        <p class="hidden" {{$count=0}}</p>
        @foreach($products as $product)
          @if ($count >5 && $count % 6 == 0)
            <div class="clearfix visible-lg"></div>
          @endif 
          @if ($count >0 && $count % 3 == 0)
            <div class="clearfix visible-sm"></div>
          @endif 
          @if ($count >0 && $count % 4 == 0)
            <div class="clearfix visible-md"></div>
          @endif 
         <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
            <div class="thumbnail">
                <a href= {{ "/buy/". $product->id }}> <img  src=  {{ URL::to('/'). "/images/products/" . $product->image}} class = "product_photo"></a>
                <p class = "text-center">${{$product->our_price}}</p>
                <div class="caption">
                  <h4 class="text-center">{{$product->product_name}}</h4>
                  
                </div>
             </div>
            
         </div> 
         <p class="hidden" {{$count++}}></p>
        @endforeach
    </div>
     <div class="text-center">
        {!! $products->links() !!}
  </div>
</div>
@stop
