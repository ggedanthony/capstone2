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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//show all asset
Route::get('/storage', 'StorageController@index');
//route to add a asset form
Route::get('/storage/add', 'StorageController@add_asset_form');
//route to update an form
Route::get('/storage/update/{id}', 'StorageController@update_asset_form');
//route to request form
Route::get('/storage/request/{id}', 'OrderController@request_asset_form');
//Approve a request
Route::get('/request/approved/{id}', 'OrderController@approve');
//Decline a request
Route::get('/request/declined/{id}', 'OrderController@decline');
//Delete a request
Route::get('/request/delete/{id}', 'OrderController@delete');
//Route to update the requested asset
Route::get('/request/update/{id}', 'OrderController@update_request');
//Return approved asset
Route::get('/request/return/{id}', 'OrderController@return_request');
//Route to history page
Route::get('/storage/history', 'OrderController@history');

//view requests
// Route::get('/request', 'OrderController@view_request');

//view all pending request
Route::get('/request/pending', 'OrderController@view_pending');
//view all approved assets
Route::get('/request/approved', 'OrderController@view_approved');
//view all assets on hold
Route::get('/request/hold', 'OrderController@view_hold');
//add a asset
Route::post('/storage', 'StorageController@add_asset');
//request asset
Route::put('/storage/request/{id}', 'OrderController@request_asset');
//updating the requested asset
Route::put('/request/update/{id}', 'OrderController@updating_request');
//returning assets that was approved
Route::put('/request/return/{id}', 'OrderController@return_asset');
//update a asset
Route::patch('/storage/update/{id}', 'StorageController@update_asset');
//delete an asset
Route::delete('/storage/delete/{id}', 'StorageController@delete_asset');