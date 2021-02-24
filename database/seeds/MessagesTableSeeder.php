<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<20;$i++)
    	{
	        DB::table('messages')->insert([
				'titre' => Str::random(10),
				'contenu' => Str::random(40),
				'profil_id' => 4,		
	 		]);
	    }
    }
}
