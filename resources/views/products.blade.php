@extends('manage')
@section('content')
<div class="container">


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form action={{ url('update') }} method ="POST"  enctype="multipart/form-data">
      {{ csrf_field() }}
         <input type ="hidden" name="_method" value = "PUT">
          <div class="form-group">
            <input type = "text" class ="form-control product-id hidden" name="product_id">

            <label for="product-name" class="control-label">Product name</label>
            <input type="text" class="form-control product-name" id="product-name" name="product_name">
          </div>
          <div class="form-group">
            <label for="product-description" class="control-label">Product description</label>
            <textarea class="form-control product-description" id="product-description" name = "product_description"></textarea>
          </div>
          <div class="form-group">
            <label for="our-price" class="control-label">Our Price</label>
            <input type = "text" class="form-control our-price" id="our-price" name ="our_price"></textarea>
          </div>
          <div class="form-group">
            <label for="market-price" class="control-label">Market Price</label>
            <input type = "text" class="form-control market-price" id="market-price" name = "market_price"></textarea>
          </div>
          <div class="form-group">
            <label for="amount" class="control-label">Amount</label>
            <input type = "text" class="form-control amount" id="amount" name = "amount"></textarea>
          </div>
          <div class="form-group">
            <label for="product-thumnail" class="control-label">Product Photo</label>
              <div class="thumnail">
               <img class="product-thumnail" location ={{ URL::to('/'). "/images/products/"}} alt="..." width = "100px" height="100px">
              </div>
          </div>
          <div class="form-group">
            <label for="product-photo-change" class="control-label">Change Product's photo</label>
            <input type = "file" class="form-control product-photo-change" id="product-photo" name = "product_photo"></textarea>
          </div>
          <div class="form-group">
            <button type= "submit" class= "btn btn-lg btn-primary ">

              <i class="fa fa-floppy-o"></i> Save
            </button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="confirmDelete" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete item</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this item?</p>
      </div>
      <form method="POST" id = "delete_form" >
                  {!! csrf_field() !!}
                  {!! method_field('DELETE') !!}
        <div class="modal-footer">
          
            <button type="submit" class="btn btn-danger confirm_delete" >Delete</button>
          
            <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>

  </div>
</div>


	<div class = "row">

		<div class="panel panel-default">
 
 		 <div class="panel-heading">All Products</div>

 
 		 <table class="table">
 		 	<tr>
 		 		<th>ID</th>
 		 		<th>Product Name</th>
        <th>Product Description</th>
 		 		<th>Available</th>
 		 		<th>Other Price</th>
 		 		<th>Our Price</th>	
 		 	</tr>	
  			@foreach($products as $product)
  				<tr>
  					<td>{{$product->id}}</td>
  					<td>{{$product->product_name}}</td>
            <td>{{$product->product_description}}</td> 
  					<td>{{$product->number}}</td>
  					<td>{{$product->market_price}}</td>
  					<td>{{$product->our_price}}</td>
            <td class="hidden">{{$product->image}}</td>
  					<td>
                <button type="button" class = "btn btn-default btn-sm btn-primary update_btn" data-toggle="modal" data-target="#exampleModal" >
                  <i class="fa fa-pencil-square-o"></i> Update
                </button>
            </td>
            <td>
              <form action={{ url('delete/'.$product->id) }} method="POST">
                  {!! csrf_field() !!}
                  {!! method_field('DELETE') !!}

                  <button type="button" class = "btn  btn-sm btn-danger delete_btn" product_id ={{$product->id}} data-toggle="modal" data-target="#confirmDelete">
                      <i class="fa fa-trash"></i> Delete
                  </button>
              </form>


              </td>

  				</tr>
  			@endforeach
 		 </table>

</div>  

	</div>
  <div class="text-center">
        {!! $products->links() !!}
  </div>
</div>
@stop





