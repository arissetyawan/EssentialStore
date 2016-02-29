$(document).ready(function(){
	console.log('i am included');
	$('.update_btn').click( function (event) {
	  //get information of the current row
	  var tds = new Array();
	  tds = $(this).parent().siblings();

	  var id = $(tds[1]).attr("product_id");
	  var product_name = $(tds[2]).text();
	  var product_description = $(tds[3]).text();
	  var avalability = $(tds[4]).text();
	  var other_price = $(tds[5]).text();
	  var our_price =$(tds[6]).text();
	  var product_thumnail = $(tds[7]).text();
	  $('#exampleModal').find('.modal-title').text('Update Product details');
	  $('#exampleModal').find('.product-id').val(id);
	  $('#exampleModal').find('.product-name').val(product_name);
	  $('#exampleModal').find('.product-description').val(product_description);
	  $('#exampleModal').find('.amount').val(avalability);
	  $('#exampleModal').find('.market-price').val(other_price);
	  $('#exampleModal').find('.our-price').val(our_price);
	  var img_src = $('#exampleModal').find('.product-thumnail').attr("location") + product_thumnail;
	  console.log( img_src);
	  $('#exampleModal').find('.product-thumnail').attr("src",img_src);
	});

	$('.delete_btn').click(function (event) {
		$('#delete_form').attr("action","delete/" + $(this).attr('product_id') );
		    
        
        
	});

	
});