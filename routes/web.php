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

Route::get('about', 'PagesController@getAbout');

Route::get('contact', 'PagesController@getContact');

Route::get('/', 'PagesController@getIndex');


Route::get('events/data', 'EventController@getEvents');

Route::get('events/simulate', 'EventController@simulateEvent');

Route::get('events/stopsimulate', 'EventController@stopEventSimulation');

Route::get('events/checksimulateonload', 'EventController@checkSimulationOnLoad');

Route::get('events/{event_id}/{hash}', 'EventController@displayTicket');

Route::get('events/geteventlist', 'EventController@getEventList');


Route::get('tickets/getbyeventid', 'TicketController@getTicketsByEventId');



//Route::resource('data', 'EventController');

Route::resource('events', 'EventController');

