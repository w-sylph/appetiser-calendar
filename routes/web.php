<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PageController@index')->name('home');
Route::post('/init/routes', 'PageController@getRoutes')->name('init.get-routes');

/**
 * @Analytics
 */
Route::namespace('Calendars')->group(function() {

    Route::post('calendars/events/store', 'CalendarController@store')->name('calendars.store');
    Route::post('calendars/events/fetch', 'CalendarController@fetch')->name('calendars.fetch');

});