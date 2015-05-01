<?php

Route::group(['prefix' => 'api/v1'], function()
{
	Route::resource('time', 'TimeEntryController');

	Route::resource('user', 'UserController');

});