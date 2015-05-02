<?php 

use Laracasts\TestDummy\Factory;

class UserTest extends ApiTester
{
	public function tearDown()
	{
		DB::table('users')->truncate();
	}

	public function testFetchingUsers()
	{
		$users = Factory::times(5)->create('App\User');
		
		$this->getJson('api/v1/user');

		$this->assertResponseOk();	
	}
}