<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
		$user = new User([
			'number_id' => '114238198',
			'name' => 'Angelo',
			'last_name' => 'Estrada',
			'email' => 'estrada@gmail.com',
			'password' => '123456789',
			'remember_token' => Str::random(10),
		]);

		$user->save();
		$user->assignRole('admin');
    }
}
