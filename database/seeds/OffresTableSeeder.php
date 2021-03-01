<?php

use Illuminate\Database\Seeder;

class OffresTableSeeder extends Seeder
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
	        DB::table('offres')->insert([
				'intitule' => Str::random(10),
				'description' => Str::random(50),
				'durée' => Str::random(10),
				'ville' => Str::random(10),
				'entreprise' => Str::random(8),
				'contact' => Str::random(12),
				'PDF' => 'pdf'.$i,
				'valideO/N' => 0,
				'archiveO/N' => 0,
				'categorie_id' => 1,
				'type_id' => 5,		
	 		]);
	    }
    }
}
