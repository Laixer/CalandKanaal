<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/*
 * Static Models Only
 * Test are performed on other seeds
 */
class UserTableSeeder extends Seeder {

	public function run()
	{
		User::create(array(
			'firstname' => 'John',
			'lastname' => 'Doe',
			'email' => 'admin@0x17.nl',
			'password' => Hash::make('ABC@123')
		));
		$this->command->info('User created');
	}
}
