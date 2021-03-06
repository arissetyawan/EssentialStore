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


Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'ProductController@getProducts');
    Route::get('/', 'ProductController@getProducts');
    Route::get('/manage','ProductController@getProductsList')->middleware('admin');
    Route::get('/addProduct','ProductController@addNewProduct');
    Route::put('/update','ProductController@updateProduct');
    Route::delete('/delete/{id}','ProductController@deleteProduct');
    Route::post('/create','ProductController@createProduct')->middleware('admin');
     Route::get('/buy/{id}','ProductController@getProductDetails');
    Route::post('/yourShoppingCart/{id}','ProductController@addToShoppingCart');
    Route::get('/yourShoppingCart','ProductController@getShoppingCart');
    Route::post('/shoppingCartChanged','ProductController@shoppingCartChange'); 
     Route::delete('/yourShoppingCart/delete','ProductController@removeFromShoppingCart'); 
      Route::post('/ePay', 'ProductController@processEPay');
       Route::post('/checkout','ProductController@checkout');
    Route::get('/newCategory','CategoryController@newCategory');
    Route::post('/createCategory','CategoryController@createCategory');
    Route::get('/getProductsInCat','ProductController@getProductsInCategory');
});
