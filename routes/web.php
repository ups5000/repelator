<?php

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

/*Route::get('/', function () {
    return view('index');
});*/
Route::get('/','IndexController@index')->name('index');

Auth::routes();

//Route::get('/home', 'HomeController@home');
//Route::get('/rep','CrawlerController@get_productsByUrl');
//Route::get('/index','CrawlerController@index');
Route::get('wishlist','HomeController@wishlist');
Route::post('add_wish','WishListController@add_wish');
