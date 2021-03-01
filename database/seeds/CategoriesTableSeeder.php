<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
	        DB::table('categories')->insert([
				'designation' => Str::random(5),		
	 		]);
	    }
    }
}
