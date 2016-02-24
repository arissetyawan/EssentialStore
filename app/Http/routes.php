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
    Route::get('/manage','ProductController@getProductsList')->middleware('admin');
    Route::get('/addProduct','ProductController@addNewProduct');
    Route::put('/update','ProductController@updateProduct');
    Route::delete('/delete/{id}','ProductController@deleteProduct');
    Route::post('/create','ProductController@createProduct')->middleware('admin');
     Route::get('/buy/{id}','ProductController@getProductDetails');

});
