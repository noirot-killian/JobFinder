<?php

use Illuminate\Database\Seeder;

class ProfilsTableSeeder extends Seeder
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
	        DB::table('profils')->insert([
				'nom' => Str::random(10),
				'prenom' => Str::random(10),
				'pseudo' => Str::random(4),
				'email' => Str::random(10).'@gmail.com',
				'mdp' => bcrypt('secret'),
				'ville' => Str::random(10),
				'CP' => Str::random(5),
				'tel' => 'XX.XX.XX.XX',
				'CV' => 'cv.pdf',
				'premCoO/N' => 0,
				'isAdminO/N' => 0,
				'notifO/N' => 1,
				'contactO/N' => 0,
				'categorie_id' => 2,		
	 		]);
	    }
    }
}
