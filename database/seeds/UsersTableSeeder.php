<?php

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
    	for($i=0;$i<5;$i++)
    	{
	    	DB::table('users')->insert([
				'name' => Str::random(7),
				'email' => Str::random(10).'@gmail.com',
				'password' => bcrypt('secret'),
				'profil_id' => 1,		
			]);
		}
    }
}
