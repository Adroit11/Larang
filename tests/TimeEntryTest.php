<?php 

use Laracasts\TestDummy\Factory;

class TimeEntryTest extends ApiTester
{
	public function tearDown()
	{
		DB::table('time_entries')->truncate();
	}

	public function testFetchingTimeEntries()
	{
		$TimeEntries = Factory::times(15)->create('App\TimeEntry');
		
		$this->getJson('api/v1/time');

		$this->assertResponseOk();	
	}

	public function testCreatingANewTimeEntryGivenValidParameters()
	{
		$attributes = Factory::attributesFor('App\TimeEntry');

		$this->getJson('api/v1/time', 'POST', $attributes);

		$this->assertResponseStatus(200);
	}

	public function testUpdatingATimeEntryGivenValidParameters()
	{
		$timeEntry = Factory::create('App\TimeEntry');

		$this->getJson('api/v1/time/'.$timeEntry->id, 'PUT', [
			'comment' => 'This is the new comment',
			'start_time' => '2015-02-21T18:56:48Z',
			'end_time' => '2015-02-21T20:33:10Z',
			'user_id' => $timeEntry->user_id
		]);

		$this->assertResponseStatus(200);
	}

	public function testDeletingATimeEntrySuccesfully()
	{
		$timeEntry = Factory::create('App\TimeEntry');

		$this->getJson('api/v1/time/'.$timeEntry->id, 'delete', []);

		$this->assertResponseStatus(200);
	}

}