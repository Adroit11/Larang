<?php namespace App\Transformers;

use App\User;

class TimeEntryTransformer extends Transformer
{
	//This will transform a simgle object or lesson
	public function transform($timeEntry)
	{
		$user = User::find($timeEntry['user_id']); 


		return [

			'id' 				=> $timeEntry['id'],
			'user_id'			=> $user->id,
			'user_firstname' 	=> $user->first_name,
			'user_lastname' 	=> $user->first_name,
			'start_time'		=> $timeEntry['start_time'],
			'end_time'			=> $timeEntry['end_time'],
			'comment'			=> $timeEntry['comment']
		];
	}
}