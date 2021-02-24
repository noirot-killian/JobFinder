<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
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
	        DB::table('types')->insert([
				'nom' => Str::random(5),		
	 		]);
	    }
    }
}
