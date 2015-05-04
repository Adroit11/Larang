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

	public function testUpdatingAUserGivenValidParameters()
	{
		$user = Factory::create('App\User');

		$this->getJson('api/v1/user/'.$user->id, 'PUT', [
			'first_name' => 'newfirstname',
			'last_name' => 'newlastname'
		]);

		$this->assertResponseStatus(200);
	}
	
}