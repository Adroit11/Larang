<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'time_entries';

	/**
	 * The items that could be mass assigned
	 *
	 * @var array $fillable
	 */
	protected $fillable = ['user_id', 'start_time', 'end_time', 'comment'];

	/**
	 * The time entry belongs to a User
	 */
	public function user()
	{
		$this->belongsTo('App\User');
	}



}
