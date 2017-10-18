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

// Basic pagaes

Route::get('/', function(){
    return redirect()->route('events.index');
});
Route::get('about', 'PagesController@getAbout');
Route::get('contact', 'PagesController@getContact');

// Event Pages


Route::get('events/data', 'EventController@getEvents');
Route::get('events/simulate', 'EventController@simulateEvent');
Route::get('events/stopsimulate', 'EventController@stopEventSimulation');
Route::get('events/checksimulateonload', 'EventController@checkSimulationOnLoad');
//Route::get('events/{slug}', ['as' => 'event.show', 'uses' => 'PublicEventController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('events/geteventlist', 'EventController@getEventList');
Route::get('events/geteventdata', 'EventController@getEventData');
Route::get('events/list', 'EventController@listEvents');

Route::resource('events', 'EventController');



// Ticket pages
Route::get('tickets/getbyeventid', 'TicketController@getTicketsByEventId');
Route::get('events/{slug}/{hash}', 'PublicTicketController@getSingle');
Route::get('tickets/sell', 'PublicTicketController@sellTicket');
Route::post('tickets/userstore',  ['as' => 'tickets.userstore', 'uses' => 'PublicTicketController@storeTicket']);
//Route::get('tickets/sell/{id}', 'PublicTicketController@storeTicket');

// Login pages
Route::get('login/facebook',  ['as' => 'login.facebook', 'uses' => 'Auth\LoginController@redirectToProvider']);
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

// Auth Routes
Auth::routes();



// Categories
Route::resource('categories', 'CategoryController', ['except' => ['create']]);

// Tags
Route::resource('tags', 'TagController', ['except' => ['create']]);

/// Instagram
Route::get('instagram/{hashtag}', 'InstagramController@displayByHashtag');

// Cart
Route::get('/checkout', ['as' => 'cart.checkout', 'uses'=> 'CartController@checkout']);


Route::resource('/cart', 'CartController', ['only' => ['index', 'store', 'update', 'destroy']]);

Route::get('/add-to-cart/{id}', [
    'uses' => 'PublicTicketController@getAddToCart',
    'as' => 'product.addToCart']);


// Orders
Route::get('/checkout/order/{id}', ['as' => 'cart.showorder', 'uses'=> 'CartController@orderAfterCheckout']);

