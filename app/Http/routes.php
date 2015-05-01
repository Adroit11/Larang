<?php

Route::get('/', function()
{
	return view('index');
});

Route::group(['prefix' => 'api/v1'], function()
{
	Route::resource('time', 'TimeEntryController');

	Route::resource('user', 'UserController');

});

// Route::resource('time', 'TimeEntryController');

// Route::resource('user', 'UserController');