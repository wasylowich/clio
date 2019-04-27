<?php

use Clio\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Create Brian
		$brian = factory(User::class)->create(['name' => 'Brian', 'api_token' => 'b-secret']);

    	// Create Thomas
		$thomas = factory(User::class)->create(['name' => 'Thomas', 'api_token' => 't-secret']);

    	// Create Siyan
		$siyan = factory(User::class)->create(['name' => 'Siyan', 'api_token' => 's-secret']);

		// Create some random users
		factory(User::class, 5)->create();
    }
}
