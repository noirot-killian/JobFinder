<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
				'duree' => Str::random(10),
				'date_debut' => Carbon::now(),
				'date_fin' => Carbon::now(),
				'entreprise' => Str::random(8),
				'ville' => Str::random(10),
				'email' => Str::random(12),
				'tel' => Str::random(8),
				'PDF' => 'pdf'.$i,
				'valideO/N' => 0,
				'archiveO/N' => 0,
				'categorie_id' => 2,
				'type_id' => 5,		
	 		]);
	    }
    }
}
