<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product as Product;

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
}
