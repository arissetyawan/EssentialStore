<?php
use App\Product as Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



Route::post('/create', function (Request $request) {
   
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
});

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

     Route::get('/home', 'ProductController@getProducts');
    Route::get('/manage','ProductController@getProductsList');
    Route::get('/addProduct','ProductController@addNewProduct');
});
