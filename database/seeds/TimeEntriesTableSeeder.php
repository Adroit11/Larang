<?php
use Illuminate\Database\Seeder;
use App\TimeEntry;
use Faker\Factory as Faker;

class TimeEntriesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();

		$userIds = DB::table('users')->lists('id');

		foreach (range(1, 15) as $index) {
		
			TimeEntry::create([
				'user_id'		=> $faker->randomElement($userIds),
				'start_time' => '2015-03-21T18:56:48Z',
				'end_time' => '2015-03-21T20:33:10Z',
				'comment' => $faker->text,
			]);
		}
	}
}