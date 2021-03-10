<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOffreProfilFavorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('offre_profil_favoris', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->primary(['offre_id', 'profil_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offre_profil_favoris', function (Blueprint $table) {
            $table->dropForeign('offre_id');
            $table->dropForeign('profil_id');
            $table->dropColumn('offre_id');
            $table->dropColumn('profil_id');
            $table->id();
        });
        
    }
}
