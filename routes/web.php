<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ArticleController@index')->name('index');
Route::get('design', 'ArticleController@design')->name('design');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('{url}', function (Request $req){

    session(['locale' => $req->segment(1)]);
    return Redirect::back();

})->where(['url' => '(es|en)'])->name('language');

Route::get('product', 'ArticleController@find')->name('product');

Route::get('bag', 'UserController@bag')->middleware(['auth', 'role:0'])->name('bag');
Route::get('buy', 'UserController@buy')->middleware(['auth', 'role:0'])->name('buy');

Route::get('admin', 'AdminController@index')->middleware(['auth', 'role:1'])->name('admin');
Route::get('home', 'UserController@index')->middleware(['auth', 'role:0'])->name('profile');

Auth::routes();

Route::fallback(function (){
    return view('404');
});
