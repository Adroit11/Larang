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
}