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
			'firstname' => 'Yorick',
			'lastname' => 'de Wid',
			'email' => 'yorick17@outlook.com',
			'password' => Hash::make('ABC@123'),
			'priv' => 'admin'
		));
		$this->command->info('Dinux created');

		User::create(array(
			'firstname' => 'Don',
			'lastname' => 'Zandbergen',
			'email' => 'don@xxx',
			'password' => Hash::make('ABC@123'),
			'priv' => 'admin'
		));
		$this->command->info('Don created');

		User::create(array(
			'firstname' => 'Demo',
			'lastname' => 'User',
			'email' => 'guest@xxx',
			'password' => Hash::make('guest')
		));
		$this->command->info('Guest created');
	}
}
