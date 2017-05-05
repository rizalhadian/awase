<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return Redirect::to('/admin');
});

Route::get('/role', [
  'middleware' => 'role:editor',
  'uses' => 'TestController@index'
]);

// Route::get('/login', 'CAuth@index');
//
//
Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/admin', 'Admin@index');

//Route Earthquake Impacts
Route::get('/admin/earthquakesimpacts', "EarthquakesImpacts@index");
Route::get('/admin/earthquakesimpacts/showAll', 'EarthquakesImpacts@showAll');
Route::get('/admin/earthquakesimpacts/showRecent', 'EarthquakesImpacts@showRecent');
Route::get('/admin/earthquakesimpacts/count', 'EarthquakesImpacts@count');
Route::post('/admin/earthquakesimpacts/create', 'EarthquakesImpacts@create');
Route::post('/admin/earthquakesimpacts/show', 'EarthquakesImpacts@showId');
Route::post('/admin/earthquakesimpacts/update', 'EarthquakesImpacts@update');
Route::post('/admin/earthquakesimpacts/destroy', 'EarthquakesImpacts@destroy');
Route::get('/admin/earthquakesimpacts/search/', 'EarthquakesImpacts@search');

//Route Help Status
Route::get('/admin/disasterstatus', 'DisasterStatus@index');
Route::post('/admin/disasterstatus/create', 'DisasterStatus@create');
Route::post('/admin/disasterstatus/show', 'DisasterStatus@showId');
Route::post('/admin/disasterstatus/update', 'DisasterStatus@update');
Route::post('/admin/disasterstatus/destroy', 'DisasterStatus@destroy');
Route::get('/admin/disasterstatus/search/', 'DisasterStatus@search');

//Route Help Status
Route::get('/admin/helpstatus', 'HelpStatus@index');
Route::post('/admin/helpstatus/create', 'HelpStatus@create');
Route::post('/admin/helpstatus/show', 'HelpStatus@showId');
Route::post('/admin/helpstatus/update', 'HelpStatus@update');
Route::post('/admin/helpstatus/destroy', 'HelpStatus@destroy');
Route::get('/admin/helpstatus/search/', 'HelpStatus@search');

//Route Earthquakes
Route::get('/admin/earthquakes', 'Earthquakes@index');
Route::get('/admin/earthquakes/showRecent', 'Earthquakes@showRecent');
Route::get('/admin/earthquakes/trigger', 'Earthquakes@triggerCheckAddEarthquake');
Route::get('/admin/earthquakes/showPaging', 'Earthquakes@showAllPaging');
Route::post('/admin/earthquakes/showDetail', 'Earthquakes@showDetail');
Route::get('/admin/earthquakes/showAll', 'Earthquakes@showAll');

//Route Disasters
Route::get('/admin/disasters', "Disasters@index");
Route::get('/admin/disasters/showAll', 'Disasters@showAll');
Route::get('/admin/disasters/count', 'Disasters@count');
Route::post('/admin/disasters/create', 'Disasters@create');
Route::post('/admin/disasters/show', 'Disasters@showId');
Route::post('/admin/disasters/update', 'Disasters@update');
Route::post('/admin/disasters/destroy', 'Disasters@destroy');
Route::get('/admin/disasters/search/', 'Disasters@search');


Route::post('/api/auth', 'AuthenticateController@auth');
