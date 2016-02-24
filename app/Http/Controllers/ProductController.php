<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product as Product;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{


		function getProducts(){

        $products = Product::paginate(12);
    	$data = array('products' => $products);

       
    		return view('home',$data);
    	}
       function getProductsList(){
        $products = Product::paginate(5);
    	//$products = Product::all();
    	$data = array('products' => $products);
    	return view('products',$data);
    	}

    	function addNewProduct(){
        return view('newProduct');
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
        $product->products_description = $request->product_description;
        $product->other_price = $request->market_price;
        $product->our_price = $request->our_price;
        $product->available = $request->amount;
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
         $file = Input::file('product_photo');
        $filename = time() . '.' .$file->getClientOriginalExtension();
        $path = public_path('images/products/' . $filename);
        Image::make($file->getRealPath())->save($path);
       
        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->number = $request->amount;
        $product->our_price = $request->our_price;
        $product->market_price = $request->market_price;
        $product->image = $filename;
        $product->save();
        
        
        return redirect('/');
    }

    function getProductDetails($id){
        
       return view('productDetails', ['product' => Product::findOrFail($id)]);

    }

}









