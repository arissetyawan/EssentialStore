<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product as Product;
use App\Category as Category;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Session;
use DB;
use Illuminate\Support\Facades\Validator;
require_once base_path(). '/vendor/autoload.php';
class ProductController extends Controller
{


		function getProducts(){

        $products = Product::paginate(12);
    	$data = array('products' => $products);

       
    		return view('home',$data);
    	}
       function getProductsList(){
        $products = Product::paginate(5);
    
      $categories = Category::all();
      
    	return view('products',['products' =>$products, 'categories' => $categories]);
    	}

    	function addNewProduct(){
        //get all the categories
        $categories = Category::all();
        return view('newProduct',['categories' => $categories]);
    }

    //update product 
    function updateProduct(Request $request){

        $file = Input::file('product_photo');
        $filename = "";
        if ($file){
            $filename = time() . '.' .$file->getClientOriginalExtension();
            $path = public_path('images/products/' . $filename);
            Image::make($file->getRealPath())->save($path);
            //$file->move(public_path('images/products/'), $filename);
            echo ($path);
        }    
        $id = $request->product_id;
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->market_price = $request->market_price;
        $product->our_price = $request->our_price;
        $product->number = $request->amount;
        $product->category_id = $request->category_id;
        if (strlen($filename) >0)
            $product->image = $filename;
        $product->save();
        return redirect('/manage');
    }

    //delete a product from database
    function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();

        return redirect('/manage');
    }

    //create a product

    function createProduct(Request $request){
         $validator = Validator::make($request->all(), [
          'product_name' => 'required|max:255',
          'product_description' =>'required',
          'category_id' =>'required',
          'amount' =>'required|numeric',
          'our_price' =>'required|numeric',
          'market_price' =>'required|numeric'
          ]);

          if ($validator->fails()) {
              return redirect('/addProduct')
                  ->withInput()
                  ->withErrors($validator);
          }

      
        $product = new Product;
       
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->category_id = $request->category_id;
        $product->number = $request->amount;
        $product->our_price = $request->our_price;
        $product->market_price = $request->market_price;
        //store images and save image name in the database
        if (Input::hasFile('product_photo'))  {
          $file = Input::file('product_photo');
          $filename = time() . '.' .$file->getClientOriginalExtension();
          $path = public_path('images/products/' . $filename);
          Image::make($file->getRealPath())->save($path);
          $product->image = $filename;
        }
       
        $product->save();
        
        
        return redirect('/addProduct');
    }

    function getProductDetails($id){
        
       return view('productDetails', ['product' => Product::findOrFail($id)]);

    }

      //add to shopping card using session
      function addToShoppingCart(Request $request, $id){
        
      $product = Product::find($id);
      $quantity = intval( $request->input('quantity'));
      

      //check to see if this product is already in the session

       $orders  = Session::get('orders');
       $found= false;
         $post_data = array(
                  
                        'product_id' => $id,
                        'product_name' =>$product->product_name,
                        'product_image' => $product->image,
                        'product_price' => $product->our_price,
                        'quantity' =>$quantity,
                        'subtotal' =>floatval($quantity) * $product->our_price
                        
                    );
            
       if (count($orders) >0){
           for ($i=0; $i<=  max(array_keys($orders)); $i++) {
               if (array_key_exists($i, $orders)){ 
                       $product_id = $orders[$i]['product_id'];
                       //if found, just change the quantity and subtotal 
                       if($product_id === $id){
                            $orders[$i]['quantity'] += $quantity;
                            $orders[$i]['subtotal'] += floatval($quantity) * $product->our_price;
                            $found = true;
                            Session::forget('orders');
                            Session::put('orders',$orders);
                            break;

                       }
                   }
           }
           if (!$found){
            Session::push("orders", $post_data);
           }
       }
       else{
                Session::push("orders", $post_data);
            }
     
       $orders  = Session::get('orders');
       
        return view('yourShoppingCart',['orders' => Session::get('orders')]);
    }


     function removeFromShoppingCart(Request $request){
        $product_id = $request->input('product_id');
        //search in session and remove this produc with this id
        $orders  = Session::get('orders');
   
        for ($i=0; $i<= max(array_keys($orders)); $i++) {
            # code..
            if (array_key_exists($i, $orders)){
                if ($product_id == $orders[$i]['product_id']){
                    unset($orders[$i]);
                    break;
                }
            }    
        }

        Session::forget('orders');
        Session::put('orders',$orders);
        return view('yourShoppingCart',['orders' => Session::get('orders')]);

    }
    function shoppingCartChange(Request $request){
        //update the number of the product changed

        $product_id = $request->input('product_id');
        $product = Product::find($product_id);    
        $quantity = $request->input('newQuantity');
        $orders = Session::get('orders');
        if (count($orders) >0){
               for ($i=0; $i<=  max(array_keys($orders)); $i++) {
                   if (array_key_exists($i, $orders)){ 
                           $product_id_index = $orders[$i]['product_id'];
                           //if found, just change the quantity and subtotal 
                           if($product_id === $product_id_index){
                                $orders[$i]['quantity'] = $quantity;
                                $orders[$i]['subtotal'] = floatval($quantity) * $product->our_price;
                                Session::forget('orders');
                                Session::put('orders',$orders);
                                break;

                           }
                       }
               }

        }
        return view('yourShoppingCart',['orders' => Session::get('orders')]);
        }

    function checkout(){
         //echo(Config::get('stripe.secret_key'));
         \Stripe\Stripe::setApiKey('sk_test_02NBgD6sbIQlXTPKi34phaeb');
         $token = Input::get('stripeToken');
         echo $token;
         $amount = Input::get('amount');
          $customer = \Stripe\Customer::create(array(
              'email' => 'customer@example.com',
              'card'  => $token
          ));

         $charge = \Stripe\Charge::create(array(
            'customer' => $customer->id,
            'amount'   => $amount,
            'currency' => 'usd'
        ));

        echo '<h1>Successfully charged $'. $amount .' </h1>';
    }   

       function processEPay(){
      return view('pay',['orders' => Session::get('orders')]);
    } 


    function getProductsInCategory(Request $request){
       $cat = $request->input('cat');
       $id =  DB::table('categories')->where('category_name', $cat)->value('id');
      //get all products with category_id equal to $id
      $products = Product::where('category_id', $id)->paginate(12);
     
      return view('home',['products' => $products]);
    }      

}









