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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('/home');
   });
});

Auth::routes();	

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/orders', 'HomeController@getOrders')->name('getOrders');



Route::get('/weds', 'HomeController@getNoWeds')->name('no_weds');

Route::group(['prefix' => 'category'], function() {
    Route::get('', [
        'uses' => 'CategoriesController@index',
        'as' => 'category.index'
    ]);
    Route::post('add', [
        'uses' => 'CategoriesController@addCategory',
        'as' => 'category.addCategory'
    ]);

         

});




Route::group(['prefix' => 'menu'], function() {
    Route::get('', [
        'uses' => 'MenusController@index',
        'as' => 'menus.index'
    ]);


//  ********* Routes for First Meals
    Route::get('first', [
        'uses' => 'MenusController@getFirstMeal',
        'as' => 'menus.first'
    ]);

    Route::get('delete/first/{id}', [
        'uses' => 'MenusController@deleteFirst',
        'as' => 'menus.delete_first'
    ]);

    Route::get('edit/first/{id}', [
        'uses' => 'MenusController@editFirst',
        'as' => 'menus.edit_first'
    ]);
    
   
    Route::post('update/first', [
        'uses' => 'MenusController@updateFirst',
        'as' => 'menus.update_first'
    ]);

    // ******* Routes for Second Meals

    Route::get('second', [
        'uses' => 'MenusController@getSecondMeal',
        'as' => 'menus.second'
    ]);

    Route::get('delete/second/{id}', [
        'uses' => 'MenusController@deleteSecond',
        'as' => 'menus.delete_second'
    ]);

    Route::get('edit/second/{id}', [
        'uses' => 'MenusController@editSecond',
        'as' => 'menus.edit_second'
    ]);
    
   
    Route::post('update/second', [
        'uses' => 'MenusController@updateSecond',
        'as' => 'menus.update_second'
    ]);

    // ******* Salads Routes ********
      Route::get('salads', [
        'uses' => 'MenusController@getSalads',
        'as' => 'menus.salads'
    ]);



});
