<?php

/*
|--------------------------------------------------------------------------
| Product Types Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {

    // Route::get('property_beds', 'PropertyBedController@index')->name('property_beds.index');
    // Route::get("property_beds/create/",'PropertyBedController@create')->name('property_beds.create');
    // Route::post("property_beds/store/",'PropertyBedController@store')->name('property_beds.store');
    // Route::get("property_beds/edit/{id}",'PropertyBedController@edit')->name('property_beds.edit');
    // Route::post("property_beds/update/{id}",'PropertyBedController@update')->name('property_beds.update');
    // Route::get('property_beds/destroy/{id}', 'PropertyBedController@destroy')->name('property_beds.destroy');
   
    
});