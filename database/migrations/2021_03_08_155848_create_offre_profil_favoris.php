<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffreProfilFavoris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offre_profil_favoris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offre_id');
            $table->foreign('offre_id')->references('id')->on('offres');
            $table->unsignedBigInteger('profil_id');
            $table->foreign('profil_id')->references('id')->on('profils');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offres_profils', function (Blueprint $table) {
            $table->dropForeign('offre_id');
            $table->dropForeign('profil_id');
        });
        Schema::dropIfExists('offre_profil_favoris');
    }
}
