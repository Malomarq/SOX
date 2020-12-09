<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/products',     "api\ArticleController@listAll");
Route::post('/product/{id}', 'api\ArticleController@list');
Route::post('/search', 'api\ArticleController@search');
Route::post('/upload', 'api\ArticleController@upload');
Route::post('/delete', 'api\ArticleController@delete');
Route::post('/update', 'api\ArticleController@update');

Route::post('/listUsers', 'api\UserController@listAll');
Route::post('/findUser', 'api\UserController@findUser');
Route::post('/updatePass', 'api\UserController@updatePass');
Route::post('/updateInfo', 'api\UserController@updateInfo');
Route::post('/checkPass', 'api\UserController@checkPass');
Route::post('/deleteUser', 'api\UserController@deleteUser');
Route::post('/getUsers', 'api\UserController@getUsers');

Route::post('/listAdmins', 'api\AdminController@listAdmins');
Route::post('/findAdmin', 'api\AdminController@findAdmin');
Route::post('/deleteAdmin', 'api\AdminController@deleteAdmin');
Route::post('/updateAdmin', 'api\AdminController@updateAdmin');
Route::post('/createAdmin', 'api\AdminController@createAdmin');
Route::post('/checkEmail', 'api\AdminController@checkEmail');
Route::post('/searchUser', 'api\AdminController@searchUser');
Route::post('/searchOrder', 'api\AdminController@searchOrder');

Route::post('/addToCart', 'api\ShoppingBagController@add');
Route::post('/getItems', 'api\ShoppingBagController@getItems');
Route::post('/getBag', 'api\ShoppingBagController@getBag');
Route::post('/amountchange', 'api\ShoppingBagController@amountchange');
Route::post('/deleteSet', 'api\ShoppingBagController@deleteSet');
Route::post('/buybag', 'api\ShoppingBagController@buybag');

Route::post('/orders', 'api\OrderController@listOrders');
Route::post('/findOrders', 'api\OrderController@findOrders');
Route::post('/orderPrice', 'api\OrderController@orderPrice');
Route::post('/getSales', 'api\OrderController@getSales');

Route::post('/sets', 'api\SetController@listSets');

Route::fallback(function(){
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');


