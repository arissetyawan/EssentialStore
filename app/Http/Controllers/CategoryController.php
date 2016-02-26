<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category as Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    function newCategory(Request $request){
    	return view('newCategory');
        
        

    }

    function createCategory(Request $request){
    	$category = new Category;
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
        $category->save();
        return redirect('/manage');
    }


  
}
