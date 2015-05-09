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
			'email' => 'admin@xxx',
			'password' => Hash::make('admin')
		));
		$this->command->info('User created');
	}
}
