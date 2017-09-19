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
//Route::get('events/{event_id}/{hash}', 'EventController@displayTicket');
Route::get('events/geteventlist', 'EventController@getEventList');
Route::get('events/list', 'EventController@listEvents')->middleware('auth');

Route::resource('events', 'EventController');



// Ticket pages

Route::get('tickets/getbyeventid', 'TicketController@getTicketsByEventId');
Route::get('events/{slug}/{hash}', 'PublicTicketController@getSingle');

// Login pages

Route::get('login/facebook',  ['as' => 'login.facebook', 'uses' => 'Auth\LoginController@redirectToProvider']);
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

// Auth Routes
Auth::routes();





Route::get('/home', 'HomeController@index');


// Categories

Route::resource('categories', 'CategoryController', ['except' => ['create']]);

// Tags

Route::resource('tags', 'TagController', ['except' => ['create']]);

/// Instagram

Route::get('instagram/{hashtag}', 'InstagramController@displayByHashtag');

/////////////////////// Checkout

Route::get('/{order?}', [
    'name' => 'PayPal Express Checkout',
    'as' => 'app.home',
    'uses' => 'PayPalController@form',
]);

Route::post('/checkout/payment/{order}/paypal', [
    'name' => 'PayPal Express Checkout',
    'as' => 'checkout.payment.paypal',
    'uses' => 'PayPalController@checkout',
]);

Route::get('/paypal/checkout/{order}/completed', [
    'name' => 'PayPal Express Checkout',
    'as' => 'paypal.checkout.completed',
    'uses' => 'PayPalController@completed',
]);

Route::get('/paypal/checkout/{order}/cancelled', [
    'name' => 'PayPal Express Checkout',
    'as' => 'paypal.checkout.cancelled',
    'uses' => 'PayPalController@cancelled',
]);

Route::post('/webhook/paypal/{order?}/{env?}', [
    'name' => 'PayPal Express IPN',
    'as' => 'webhook.paypal.ipn',
    'uses' => 'PayPalController@webhook',
]);


