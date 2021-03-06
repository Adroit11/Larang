<?php 
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 10) as $index) {
		
			User::create([
				'firstname' 	=> 	$faker->firstName,
				'lastname'		=> 	$faker->lastName,
				'email'			=>	$faker->unique()->email,
				'password'		=> 	bcrypt('secret'),
				'gender'		=>	$faker->randomElement(['M','F']),
				'birthday'		=>	$faker->date,
				'profileimage'	=>	$faker->imageUrl($width = 180, $height = 180)
			]);
		}
	}
}