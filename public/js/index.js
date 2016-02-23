$(document).ready(function(){
	var description = $('.dummy').text();
	description = "<b> General information </b><br>" + description + "<br>";
	description +="<b>Warnings</b><br>";
	description +="<b>Ingredients</b><br>";
	description +="<b>Directions</b><br>";
	$('.product_description').html(description);

	//when user update the quantity list in product detail page
	$('.addToCart_btn').click(function(){
		console.log('changed');
		var quantity = $( ".quantityProductDetail option:selected" ).text();
		//attach the quantity to the action link
		var action_link = $('#addToCardForm').attr("action");
		$('#addToCardForm').attr("action",action_link+"?quantity=" +quantity);
		$('#addToCardForm').submit();

	});

	//quantity option list in yourShoppingCart page
	$('.quantityCart').each(function(){
		//get the sibling p
		var p_sib = $(this).siblings()[0];
		console.log($(p_sib).text());
		var value = parseInt($(p_sib).text());
		
		$(this).val(value);	

	})
	$('.quantityCart').change(function(){
		//get the selected value
		var new_quantity = $(this).val();
		console.log(new_quantity);
		//get the id of the product selected
		var product_id = $(this).attr('product_id');
		var action = $('#changeQuantity').attr("action") + "?newQuantity="+new_quantity +"&product_id=" + product_id ;
		$('#changeQuantity').attr("action",action);
		$('#changeQuantity').submit();
	});

	//if click the trash icon --> remove the corresponding product 
	$('.remove_item_icon').click(function(){
		//get the product id 
		var product_id = $(this).attr("product_id");
		var action = $('#removeItem').attr("action") + "?product_id=" +product_id;
		$('#removeItem').attr("action", action);
		$('#removeItem').submit();
	});

	/*
				var handler = StripeCheckout.configure({
			    key: 'pk_test_9AQOh2FS34hP8BEZEU91jt64',
			    image: '/images/sites/phamaStoreIcon.jpg',
			    locale: 'auto',
			    token: function(token) {
			      // Use the token to create the charge with a server-side script.
			      // You can access the token ID with `token.id`
			    }
			 	 });
			    var total = 1800;
				$('#customButton').on('click', function(e) {
					    // Open Checkout with further options
					    handler.open({
					      name: 'Demo Site',
					      description: '2 widgets',
					      currency: "aud",
					      amount: total
					    });
					    e.preventDefault();
					  });

					  // Close Checkout on page navigation
					  $(window).on('popstate', function() {
					    handler.close();

				});

	*/
});









