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

Route::any('ajax_add_wish','WishListController@ajax_add_wishProducts')->middleware('auth');
Route::any('ajax_del_wish','WishListController@ajax_del_wishProducts')->middleware('auth');
Route::get('wishlist','WishListController@index')->name('wishlist')->middleware('auth');
Route::get('share/{code}','WishListController@share')->name('publicwishlist');
