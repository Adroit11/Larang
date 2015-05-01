<?php 

$factory('App\TimeEntry', [

	'user_id' 		=> 'factory:App\User',
	'start_time'	=> '2015-02-21T18:56:48Z',
	'end_time'		=> '2015-02-21T20:33:10Z',
	'comment'		=> $faker->text

]);

$factory('App\User', [

	'first_name'	=> $faker->firstname,
	'last_name'		=> $faker->lastname,
	'email'			=> $faker->email,
	'password'		=> bcrypt('secret')

]);