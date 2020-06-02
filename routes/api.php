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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('api.auth')->group(function (){

    Route::get('/products',     "api\ArticleController@listAll");
    Route::get('/product/{id}', 'api\ArticleController@list');
    Route::get('/search', 'api\ArticleController@search');
    Route::post('/upload', 'api\ArticleController@upload');
    Route::post('/delete', 'api\ArticleController@delete');
    Route::post('/update', 'api\ArticleController@update');

    Route::get('/listUsers', 'api\UserController@listAll');

    Route::get('/listAdmins', 'api\AdminController@listAdmins');
    Route::get('/findAdmin', 'api\AdminController@findAdmin');
    Route::post('/deleteAdmin', 'api\AdminController@deleteAdmin');
    Route::post('/updateAdmin', 'api\AdminController@updateAdmin');
    Route::post('/createAdmin', 'api\AdminController@createAdmin');
    Route::get('/checkEmail', 'api\AdminController@checkEmail');



});


